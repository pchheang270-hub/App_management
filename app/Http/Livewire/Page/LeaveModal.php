<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;

class LeaveModal extends Component
{
    public $showForm = false;
    public $user_id, $start_date, $end_date, $reason, $leaveRequests;

    public function mount()
    {
        $this->loadLeaveRequests();
        if (Auth::user()->role === 'employee') {
            $this->user_id = Auth::id(); // Auto-fill for employee
        }
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function submit()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
        ]);

        Leave::create([
            'user_id' => $this->user_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'reason' => $this->reason,
            'status' => 'pending',
        ]);

        $this->reset(['showForm', 'start_date', 'end_date', 'reason']);
        if (Auth::user()->role === 'employee') {
            $this->user_id = Auth::id(); // reassign user_id
        }

        $this->loadLeaveRequests();
    }

    public function approve($id)
    {
        if (Auth::user()->role !== 'admin') return;
        Leave::findOrFail($id)->update(['status' => 'approved']);
        $this->loadLeaveRequests();
    }

    public function reject($id)
    {
        if (Auth::user()->role !== 'admin') return;
        Leave::findOrFail($id)->update(['status' => 'rejected']);
        $this->loadLeaveRequests();
    }

    public function deleteLeave($id)
    {
        $leave = Leave::findOrFail($id);
        if (Auth::user()->role === 'admin' || $leave->user_id === Auth::id()) {
            $leave->delete();
            $this->loadLeaveRequests();
        }
    }

    public function editLeave($id)
    {
        $leave = Leave::findOrFail($id);
        $this->user_id = $leave->user_id;
        $this->start_date = $leave->start_date;
        $this->end_date = $leave->end_date;
        $this->reason = $leave->reason;
        $this->showForm = true;
    }

    public function loadLeaveRequests()
    {
        $this->leaveRequests = Auth::user()->role === 'employee'
            ? Leave::with('user')->where('user_id', Auth::id())->latest()->get()
            : Leave::with('user')->latest()->get();
    }

    public function render()
    {
        return view('livewire.page.leave-modal')
            ->extends('layouts.app')
            ->section('content');
    }
}
