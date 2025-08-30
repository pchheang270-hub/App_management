<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;

class AttendanceModal extends Component
{
    use WithPagination;
    public string $selectedPeriod = 'today'; // today|week|month|year
    public string $activeTab = 'attendance'; // attendance|leave
    public $perPage = 10;
    // Flash message helper
    public function toast(string $message): void
    {
    $this->dispatchBrowserEvent('notify', ['message' => $message]);
    }


    public function setPeriod(string $period): void
    {
        $this->selectedPeriod = in_array($period, ['today','week','month','year']) ? $period : 'today';
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = in_array($tab, ['attendance','leave']) ? $tab : 'attendance';
    }

    protected function getDateRange(): array
    {
        $now = Carbon::now();
        return match ($this->selectedPeriod) {
            'today' => [Carbon::today(), Carbon::today()->endOfDay()],
            'week'  => [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()],
            'month' => [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()],
            'year'  => [$now->copy()->startOfYear(), $now->copy()->endOfYear()],
            default => [Carbon::today(), Carbon::today()->endOfDay()],
        };
    }

    public function approveLeave(int $id): void
    {
        $leave = Leave::findOrFail($id);
        if ($leave->status !== 'approved') {
            $leave->update(['status' => 'approved']);
            $this->toast('Leave request approved.');
        }
    }
    

    public function rejectLeave(int $id): void
    {
        $leave = Leave::findOrFail($id);
        if ($leave->status !== 'rejected') {
            $leave->update(['status' => 'rejected']);
            $this->toast('Leave request rejected.');
        }
    }


    public function render()
    {
        $attendanceRecords = Attendance::with('user')->paginate($this->perPage);
        $leaveRequests     = Leave::with('user')->paginate($this->perPage);

    // Example logic – adjust to match your schema
        $present = $attendanceRecords->where('status', 'present')->count();
        $absent = $attendanceRecords->where('status', 'absent')->count();
        $late = $attendanceRecords->where('status', 'late')->count();
        $noCheckIn = $attendanceRecords->whereNull('check_in')->count();
        $noCheckOut = $attendanceRecords->whereNull('check_out')->count();
        $totalEmployees = User::where('role', 'employee')->count();
        $totalRecords = $attendanceRecords->count();

        return view('livewire.page.attendance-modal', [
        'attendanceRecords' => $attendanceRecords,
        'leaveRequests'     => $leaveRequests,
        'stats' => [
            'present'=> $present,
            'absent' => $absent,
            'late' => $late,
            'noCheckIn' => $noCheckIn,
            'noCheckOut' => $noCheckOut,
            'totalEmployees'=> $totalEmployees,
            'totalRecords'=> $totalRecords,
        ]
       ])->extends('layouts.app')
         ->section('content');

    }
}
