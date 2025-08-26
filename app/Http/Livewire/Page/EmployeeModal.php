<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;

class EmployeeModal extends Component
{
    use WithFileUploads;

    public $search = '';
    public $formOpen = false;
    public $deleteOpen = false;
    public $password;
    public $usersId; // Correct property
    public $showModal = false;

    public $name, $email, $position, $department, $join_date, $status = 'active', $avatar;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->usersId,
            'password' => $this->usersId ? 'nullable|string|min:8' : 'required|string|min:8',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'join_date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'avatar' => 'nullable|image|max:1024', // max 1MB
        ];
    }

    public function openForm($id = null)
    {
        $this->resetErrorBag();
        $this->reset([
            'usersId', 'name', 'email', 'position', 'department',
            'join_date', 'status', 'avatar', 'password'
        ]);

        if ($id) {
            $user = User::findOrFail($id);
            $this->usersId = $user->id; // ✅ fix typo
            $this->name = $user->name;
            $this->email = $user->email;
            $this->position = $user->position;
            $this->department = $user->department;
            $this->join_date = $user->join_date;
            $this->status = $user->status;
            $this->avatar = null; // Avatar upload is handled separately
        }

        $this->formOpen = true;
    }

    public function save()
    {
        $this->validate();

        $avatarPath = $this->avatar ? $this->avatar->store('avatars', 'public') : null;

        User::updateOrCreate(
            ['id' => $this->usersId],
            [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password ? Hash::make($this->password) : ($this->usersId ? $user->password : Hash::make('default123')),
                'position' => $this->position,
                'department' => $this->department,
                'join_date' => $this->join_date,
                'status' => $this->status,
                'avatar' => $avatarPath ?? null,
            ]
        );

        $this->reset([
            'usersId', 'name', 'email', 'position', 'department',
            'join_date', 'status', 'avatar'
        ]);
        $this->formOpen = false;
        $this->emit('userUpdated'); // Table will listen to refresh
    }

    public function confirmDelete($id)
    {
        $this->usersId = $id;
        $this->deleteOpen = true;
    }

    public function delete()
    {
        User::find($this->usersId)?->delete();
        $this->reset(['usersId']);
        $this->deleteOpen = false;
        $this->emit('userUpdated');
    }

    public function render()
    {
        $query = User::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        return view('livewire.page.employee-modal', [
            'users' => $query->latest()->get(),
        ])->extends('layouts.app')
          ->section('content');
    }
}
