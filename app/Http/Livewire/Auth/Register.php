<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role = 'employee';
    public $position;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:admin,employee',
        'position' => 'required|string|max:255',
    ];

    public function register()
    { 
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'position' => $this->position,
            'join_date' => now(),
        ]);

        Auth::login($user);

        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('employee.dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register')
        ->extends('layouts.auth')
        ->section('content');
    }
}