<?php

namespace App\Http\Livewire\Employee;

use App\Models\Attendance;
use App\Models\Leave;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        $myAttendance = Attendance::get();
        $myLeaves = Leave::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('livewire.employee.dashboard', [
            'myAttendance' => $myAttendance,
            'myLeaves' => $myLeaves,
        ])->extends('layouts.employee')->section('content');
    }

    
}