<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Leave;
class Dashboard extends Component
{
  public $attendances;


    public function mount()
    
    {
        
        $this->attendances = Attendance::with('employee')->get();
    }

    public function checkIn()
    {
        $attendance = Attendance::updateOrCreate(
            ['user_id' => Auth::id(), 'date' => today()],
            ['check_in' => now()]
        );
        $this->reset(['formOpen', 'name', 'email', 'position', 'join_date', 'avatar', 'usersId']);
        session()->flash('success', 'Employee saved successfully!');

        $this->attendances = Attendance::with('employee')->get(); // refresh table
    }

     public function checkOut()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('date', today())
            ->whereData('date', last_7day())
            ->first();

        if ($attendance) {
            $attendance->update(['check_out' => now()]);
            $this->attendances = Attendance::with('employee')->get(); // refresh table
        }
         session()->flash('message', '✅ You have checked in successfully.');
    }
    public function render()
    {
        $totalEmployees = User::where('role', 'employee')->count();
        $todayAttendance = Attendance::whereDate('date', today())->count();
        $pendingLeaves = Leave::where('status', 'pending')->count();
        $todayAttendanceRecords = Attendance::with('user')
            ->whereDate('date', today())
            ->get();

        return view('livewire.dashboard', [
            'totalEmployees' => $totalEmployees,
            'todayAttendance' => $todayAttendance,
            'pendingLeaves' => $pendingLeaves,
            'attendanceRecords' => $todayAttendanceRecords,
        ])->extends('layouts.app')->section('content');

        // $this->section = $user->role;
    }
    

}
