<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Dashboard;
// use App\Http\Livewire\Employee\Dashboard as EmployeeDashboard;
use App\Http\Livewire\Layout\Homescreen;
use App\Http\Livewire\Page\EmployeeModal;
use App\Http\Livewire\Page\LeaveModal;


// Home/Landing page
Route::get('home', Homescreen::class)->name('home');


// ----Route Page-----
Route::get('/employee', EmployeeModal::class)->name('employee');
Route::get('/leave', LeaveModal::class)->name('leave');



// !!!Route login and register!!
  Route::get('/login', Login::class)->name('login');
  Route::get('/register', Register::class)->name('register');



// Admin routes
// / Admin dashboard route
Route::middleware(['auth', 'role:admin'])->get('/dashboard/admin', Dashboard::class)->name('admin.dashboard');

// Employee dashboard route
Route::middleware(['auth', 'role:employee'])->get('/dashboard/employee', Dashboard::class)->name('employee.dashboard');
// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');




// Guest routes (not logged in)

// Route::middleware('guest')->group(function () {
//     Route::get('/login', Login::class)->name('login');
//     Route::get('/register', Register::class)->name('register');
    

  
// });