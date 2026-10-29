<?php

use App\Livewire\Exam\Login as ExamLogin;
use App\Livewire\Staff\AdminLogin;
use App\Livewire\Staff\ProctorLogin;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// Participant login prototype; credentials will be wired after exam schema/services are implemented.
Route::get('/ujian/login', ExamLogin::class)->name('exam.login');

// Separate staff entry points. Role-based authentication is not active yet.
Route::get('/admin/login', AdminLogin::class)->name('admin.login');
Route::get('/proktor/login', ProctorLogin::class)->name('proctor.login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
