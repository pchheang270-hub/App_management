<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use App\Models\Leave;

class Dashboard extends Component
{
    public $attendances;

    public function mount()
    {
        // Removed attendance loading here as render handles it
    }

    public function checkIn()
    {
        $userId = auth()->id();

        // Prevent multiple check-ins
        $existing = Attendance::where('user_id', $userId)
            ->whereDate('date', now()->toDateString()) // use date column
            ->first();

        if ($existing) {
            session()->flash('error', 'You already checked in today!');
            return;
        }

        Attendance::create([
            'user_id' => $userId,
            'date' => now()->toDateString(), // ✅ FIX: store the date
            'check_in_time' => now()->toTimeString(),
        ]);

        session()->flash('message', 'Check-In successful!');
    }


    public function checkOut()
    {
        $userId = auth()->id();

        // Find today’s record
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

        $attendance->update(['check_out_time' => now()]);

        session()->flash('message', 'Check-Out successful!');
    }


    public function render()
    {
        $data = [];

        if (Auth::user()->role === 'admin') {
            $data = [
                'totalEmployees' => User::where('role', 'employee')->count(),
                'todayAttendance' => Attendance::whereDate('date', today())->count(),
                'pendingLeaves' => Leave::where('status', 'pending')->count(),
                'attendanceRecords' => Attendance::with('user')
                    ->whereDate('date', today())
                    ->get(),
            ];
        } else {
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

        return view('livewire.dashboard', $data)
            ->extends('layouts.app')
            ->section('content');
    }
}
