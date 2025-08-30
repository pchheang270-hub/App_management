<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Layout\Homescreen;
use App\Http\Livewire\Page\EmployeeModal;
use App\Http\Livewire\Page\LeaveModal;
use App\Http\Livewire\Page\AttendanceModal;


// Home/Landing page
Route::get('/', Homescreen::class)->name('/');

// Authentication routes (accessible to guests)
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    // Dashboard - accessible to both admin and employee
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    // Leave requests - accessible to both admin and employee
    Route::get('/leave', LeaveModal::class)->name('leave');
    
    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/employee', EmployeeModal::class)->name('employee');
        Route::get('/attendance', AttendanceModal::class)->name('attendance');
        // Add other admin-only routes here
    });
  
    
    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('/');
    })->name('logout');
});