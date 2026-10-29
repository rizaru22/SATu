<?php

use App\Livewire\Exam\Login as ExamLogin;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// Participant login prototype. Credential verification will be wired after
// the approved exam and exam-assignment migrations/services are implemented.
Route::get('/ujian/login', ExamLogin::class)->name('exam.login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
