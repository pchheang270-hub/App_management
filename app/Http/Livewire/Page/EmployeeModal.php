<?php

namespace App\Http\Livewire\Page;
use Livewire\WithPagination;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeModal extends Component
{
    use WithFileUploads;
    
    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $formOpen = false;
    public $deleteOpen = false;
    public $password;
    public $userId;

    public $name, $email, $position, $department, $join_date, $status = 'active', $avatar;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => $this->userId ? 'nullable|string|min:8' : 'required|string|min:8',
            'position' => 'required|string|max:255',
            // 'department' => 'required|string|max:255',
            'join_date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'avatar' => 'nullable|image|max:1024',
        ];
    }

    public function openForm($id = null)
    {
        $this->resetErrorBag();
        $this->reset([
            'userId', 'name', 'email', 'position', 
            'join_date', 'status', 'avatar', 'password'
        ]);

        if ($id) {
            $user = User::findOrFail($id);
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->position = $user->position;
            // $this->department = $user->department;
            $this->join_date = $user->join_date;
            $this->status = $user->status;
        }

        $this->formOpen = true;
    }

    public function save()
    {
        $this->validate();

        $user = $this->userId ? User::find($this->userId) : new User();

        $user->name = $this->name;
        $user->email = $this->email;
        if ($this->password) {
            $user->password = Hash::make($this->password);
        } elseif (!$this->userId) {
            $user->password = Hash::make('default123');
        }

        $user->position = $this->position;
        // $user->department = $this->department;
        $user->join_date = $this->join_date;
        $user->status = $this->status;

        if ($this->avatar) {
            $user->avatar = $this->avatar->store('avatars', 'public');
        }

        $user->save();

        $this->reset([
            'userId', 'name', 'email', 'position', 
            'join_date', 'status', 'avatar', 'password'
        ]);

        $this->formOpen = false;
        $this->emit('userUpdated');
    }

    public function confirmDelete($id)
    {
        $this->userId = $id;
        $this->deleteOpen = true;
    }

    public function delete()
    {
        User::find($this->userId)?->delete();
        $this->reset(['userId']);
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
            'users' => $query->latest()->paginate(10),
        ])->extends('layouts.app')
          ->section('content');
    }
}
