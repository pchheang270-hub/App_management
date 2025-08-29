<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use App\Models\Leave;

class Dashboard extends Component
{
    /*
    |--------------------------------------------------------------------------
    | Public Properties (Component State)
    |--------------------------------------------------------------------------
    | These variables hold data that will be passed to the view
    */
    public $attendances;
    public $thisMonthHours = 0;
    public $lastMonthHours = 0;
    public $monthComparison = 0; 
    public $recentLeaves;
    public $recentActivities = [];

    /*
    |--------------------------------------------------------------------------
    | Lifecycle Hook: mount()
    |--------------------------------------------------------------------------
    | Called when the component is initialized.
    | Here we load initial data like recent leaves & activities.
    */
    public function mount()
    {
        $this->loadRecentLeaves();
        $this->loadRecentActivities();
        // Attendance is loaded inside render(), not here
    }

    /*
    |--------------------------------------------------------------------------
    | Method: checkIn()
    |--------------------------------------------------------------------------
    | Allows a user to check in for today.
    | Prevents duplicate check-ins and stores check_in_time.
    */
    public function checkIn()
    {
        $userId = auth()->id();

        // Prevent multiple check-ins for the same date
        $existing = Attendance::where('user_id', $userId)
            ->whereDate('date', now()->toDateString()) // check "date" column
            ->first();

        if ($existing) {
            session()->flash('error', 'You already checked in today!');
            return;
        }

        // Store attendance
        Attendance::create([
            'user_id' => $userId,
            'date' => now()->toDateString(), // store today's date
            'check_in_time' => now()->toTimeString(), // store only time
        ]);

        session()->flash('message', 'Check-In successful!');
    }

    /*
    |--------------------------------------------------------------------------
    | Method: checkOut()
    |--------------------------------------------------------------------------
    | Allows a user to check out for today.
    | Ensures check-in exists and check-out isn't already done.
    */
    public function checkOut()
    {
        $userId = auth()->id();

        // Find today's record (based on created_at date)
        $attendance = Attendance::where('user_id', $userId)
            ->whereDate('created_at', now()->toDateString())
            ->first();

        if (!$attendance) {
            session()->flash('error', 'You have not checked in yet!');
            return;
        }

        if ($attendance->check_out_time) {
            session()->flash('error', 'You already checked out today!');
            return;
        }

        // Update record with checkout time
        $attendance->update(['check_out_time' => now()]);

        session()->flash('message', 'Check-Out successful!');
    }

    /*
    |--------------------------------------------------------------------------
    | Method: calculateMonthHours()
    |--------------------------------------------------------------------------
    | Calculates total working hours for this month and last month,
    | then computes the percentage comparison.
    */
    protected function calculateMonthHours()
    {
        $now = now();

        // Date ranges for this month & last month
        $startThisMonth = $now->copy()->startOfMonth();
        $endThisMonth   = $now->copy()->endOfMonth();

        $startLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endLastMonth   = $now->copy()->subMonth()->endOfMonth();

        // Query attendances for each month (only complete in/out records)
        $thisMonthRecords = Attendance::whereBetween('date', [$startThisMonth, $endThisMonth])
            ->whereNotNull('check_in_time')
            ->whereNotNull('check_out_time')
            ->get();

        $lastMonthRecords = Attendance::whereBetween('date', [$startLastMonth, $endLastMonth])
            ->whereNotNull('check_in_time')
            ->whereNotNull('check_out_time')
            ->get();

        // Helper function to sum hours
        $sumHours = function ($records) {
            $minutes = 0;
            foreach ($records as $att) {
                $in  = \Carbon\Carbon::parse($att->date . ' ' . $att->check_in_time);
                $out = \Carbon\Carbon::parse($att->check_out_time);

                if ($out->greaterThan($in)) {
                    $minutes += $in->diffInMinutes($out);
                }
            }
            return round($minutes / 60); // return total hours
        };

        // Store results
        $this->thisMonthHours = $sumHours($thisMonthRecords);
        $this->lastMonthHours = $sumHours($lastMonthRecords);

        // Percentage comparison
        if ($this->lastMonthHours > 0) {
            $this->monthComparison = round(
                (($this->thisMonthHours - $this->lastMonthHours) / $this->lastMonthHours) * 100
            );
        } else {
            $this->monthComparison = 0;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Method: loadRecentLeaves()
    |--------------------------------------------------------------------------
    | Loads the 5 most recent leave requests with user data.
    */
    protected function loadRecentLeaves()
    {
        $this->recentLeaves = Leave::with('user')
            ->latest()
            ->take(5)
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Method: loadRecentActivities()
    |--------------------------------------------------------------------------
    | Builds the recent activity feed by merging:
    | - New employees
    | - Leave requests
    | - Late attendances
    */
    protected function loadRecentActivities()
    {
        $activities = collect();

        // 1. New employees
        $newUsers = User::latest()->take(5)->get()->map(function ($user) {
            return [
                'type' => 'user',
                'description' => 'New employee registered',
                'name' => $user->name,
                'created_at' => $user->created_at,
                'color' => 'green',
            ];
        });

        // 2. Leave requests
        $leaves = Leave::latest()->take(5)->with('user')->get()->map(function ($leave) {
            return [
                'type' => 'leave',
                'description' => 'Leave request submitted',
                'name' => $leave->user->name ?? 'Unknown',
                'created_at' => $leave->created_at,
                'color' => 'yellow',
            ];
        });

        // 3. Late attendances (check-in after 9:00 AM)
        $lateAttendances = Attendance::whereTime('check_in_time', '>', '09:00:00')
            ->latest()
            ->take(5)
            ->with('user')
            ->get()
            ->map(function ($attendance) {
                return [
                    'type' => 'attendance',
                    'description' => 'Attendance marked late',
                    'name' => $attendance->user->name ?? 'Unknown',
                    'created_at' => $attendance->created_at,
                    'color' => 'red',
                ];
            });

        // Merge all activities and keep only the latest 5
        $this->recentActivities = $newUsers
            ->merge($leaves)
            ->merge($lateAttendances)
            ->sortByDesc('created_at')
            ->take(5)
            ->values();
    }

    /*
    |--------------------------------------------------------------------------
    | Render Method
    |--------------------------------------------------------------------------
    | Supplies the view with dashboard data depending on user role:
    | - Admins see totals for employees, attendances, and leaves
    | - Employees see only their own data
    */
    public function render()
    {
        $data = [];

        if (Auth::user()->role === 'admin') {
            // Data for Admin
            $data = [
                'totalEmployees' => User::where('role', 'employee')->count(),
                'todayAttendance' => Attendance::whereDate('date', today())->count(),
                'pendingLeaves' => Leave::where('status', 'pending')->count(),
                'attendanceRecords' => Attendance::with('user')
                    ->whereDate('date', today())
                    ->get(),
            ];
        } else {
            // Data for Employee
            $data = [
                'myAttendance' => Attendance::where('user_id', Auth::id())
                    ->whereDate('date', today())
                    ->first(),
                'myLeaves' => Leave::where('user_id', Auth::id())
                    ->where('status', 'pending')
                    ->count(),
                'attendanceRecords' => Attendance::with('user')
                    ->where('user_id', Auth::id())
                    ->whereDate('date', today())
                    ->get(),
            ];
        }

        // Return view
        return view('livewire.dashboard', $data)
            ->extends('layouts.app')
            ->section('content');
    }
}
