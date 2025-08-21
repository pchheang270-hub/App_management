<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    protected $rules = [
        'email' => 'required|string|email|max:255',
        'password' => 'required|min:8',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            $user = Auth::user();
            $role = $user->role ?? null;

            // Store the role in the session
            session(['user_role' => $role]);

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'employee') {
                return redirect()->route('employee.dashboard');
            } else {
                Auth::logout();
                $this->addError('email', 'Your user role is not recognized.');
                return;
            }
        }

        $this->addError('email', 'The provided credentials do not match our records.');
        $this->password = ''; // Clear password input
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->extends('layouts.auth')
            ->section('content');
    }
}
