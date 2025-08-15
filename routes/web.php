<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Admin\Dashboard as AdminDashboard;
use App\Http\Livewire\Employee\Dashboard as EmployeeDashboard;
use App\Http\Livewire\Layout\Homescreen;

// Home/Landing page
Route::get('/home', Homescreen::class)->name('home');


// Guest routes (not logged in)

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    // Route::post('/register', Register::class)->name('register');

  
});
// Route::post('/register', Register::class)->name('register');


// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
});

// Employee routes  
Route::middleware(['auth', 'role:employee'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', EmployeeDashboard::class)->name('dashboard');
});

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');


