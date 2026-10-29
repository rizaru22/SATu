<?php

use App\\Livewire\\Exam\\Login as ExamLogin;
use App\\Livewire\\Staff\\Login as StaffLogin;
use Illuminate\\Support\\Facades\\Route;

Route::view('/', 'welcome')->name('home');

// Participant login prototype; credentials will be wired after exam schema/services are implemented.
Route::get('/ujian/login', ExamLogin::class)->name('exam.login');

// Shared login entry point for staff (administrator and proctor).
// Role-based authentication and authorization are not active yet.
Route::get('/login', StaffLogin::class)->name('login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
