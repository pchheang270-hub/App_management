<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;
use App\Models\Leave;

class LeaveModal extends Component
{
    public $showForm = false; // controls form visibility
    public $user_id, $start_date, $end_date, $reason;
    public $leave;

    protected $listeners = ['refreshLeaves' => '$refresh'];

    public function mount()
    {
        $this->leave = Leave::with('user')->latest()->get();
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

        $this->reset(['user_id', 'start_date', 'end_date', 'reason']);
        $this->showForm = false;
        $this->mount(); // refresh the table
    }

    public function approve($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update(['status' => 'approved']);
        $this->emit('refreshLeaves');
    }

    public function reject($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update(['status' => 'rejected']);
        $this->emit('refreshLeaves');
    }

     public function editLeave($id)
    {
        // Example: load leave record
        $this->leave = \App\Models\Leave::find($id);
        $this->dispatchBrowserEvent('open-leave-modal'); // optional
    }
    public function render()
    {
        $this->leaveRequests = Leave::with('user')->latest()->get();
        return view('livewire.page.leave-modal')
        ->extends('layouts.app')   // ✅ should extend your main layout
        ->section('content');
    
    }
}




