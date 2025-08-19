<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;
use App\Models\User;

class EmployeeModal extends Component
{
    public $isOpen = false;
    public $formOpen = false;
    public $deleteOpen = false;
    public $employeeId;
    public $employeeName;
    public $name, $email, $position, $department, $joinDate, $status = 'active', $avatar;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email',
        'position' => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'joinDate' => 'required|date',
        'status' => 'required|in:active,inactive',
        'avatar' => 'nullable|string',
    ];

    protected $listeners = ['openEmployeeModal' => 'openForm'];

    // 🔹 Open Add/Edit Modal
    public function open($id = null)
    {
        $this->resetValidation();
        $this->resetExcept('DeleteOpenForm');

        if ($id) {
            $employee = User::findOrFail($id);
            $this->employeeId = $employee->id;
            $this->name = $employee->name;
            $this->email = $employee->email;
            $this->position = $employee->position;
            $this->department = $employee->department;
            $this->joinDate = $employee->join_date;
            $this->status = $employee->status;
            $this->avatar = $employee->avatar;
        }

        $this->formOpen = true;
    }

    // 🔹 Save Employee
    public function save()
    {
        $this->validate();

        User::updateOrCreate(
            ['id' => $this->employeeId],
            [
                'name' => $this->name,
                'email' => $this->email,
                'position' => $this->position,
                'department' => $this->department,
                'join_date' => $this->joinDate,
                'status' => $this->status,
                'avatar' => $this->avatar ?: "https://ui-avatars.com/api/?name=" . urlencode($this->name),
     ]
        );

        $this->reset();
        $this->emit('employeeUpdated'); // Refresh employee list
    }

    // 🔹 Open Delete Confirmation
    public function confirmDelete($id, $name)
    {
        $this->users_Id = $id;
        $this->name= $name;
        $this->deleteOpen = true;
    }

    // 🔹 Delete Employee
    public function delete()
    {
        if ($this->employeeId) {
            User::find($this->employeeId)->delete();
            $this->deleteOpen = false;
            $this->emit('employeeUpdated');
        }
    }

    public function render()
    {
    
        return view('livewire.page.employee-modal')
            ->extends('layouts.app')   // ✅ should extend your main layout
            ->section('content');
    }
}
