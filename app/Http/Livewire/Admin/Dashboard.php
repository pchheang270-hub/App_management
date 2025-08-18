<?php
namespace App\Http\Livewire\Admin;
use Livewire\Component;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Leave;
class Dashboard extends Component
{
    public function render()
    {
        $totalEmployees = User::where('role', 'employee')->count();
        $todayAttendance = Attendance::whereDate('date', today())->count();
        $pendingLeaves = Leave::where('status', 'pending')->count();
        $todayAttendanceRecords = Attendance::with('user')
            ->whereDate('date', today())
            ->get();

        return view('livewire.admin.dashboard', [
            'totalEmployees' => $totalEmployees,
            'todayAttendance' => $todayAttendance,
            'pendingLeaves' => $pendingLeaves,
            'attendanceRecords' => $todayAttendanceRecords,
        ])->extends('layouts.admin')->section('content');
    }

}
