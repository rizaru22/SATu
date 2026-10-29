<?php

namespace App\Livewire\Staff;

use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';

    public function submit(): void
    {
        $this->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        // Authentication and role-based authorization will be connected
        // when the staff account and permission model is implemented.
        session()->flash(
            'login_notice',
            'Form tervalidasi. Autentikasi staf belum diaktifkan.'
        );
    }

    public function render()
    {
        return view('livewire.staff.login')
            ->layout('layouts.exam', ['title' => 'Login Staf']);
    }
}
