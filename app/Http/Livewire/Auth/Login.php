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

       
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    { 
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('employee.dashboard');
            }
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth')->section('content');
    }
}