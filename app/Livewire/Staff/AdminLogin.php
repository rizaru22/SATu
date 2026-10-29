<?php

namespace App\Livewire\Staff;

use Livewire\Component;

class AdminLogin extends Component
{
    public string $email = '';
    public string $password = '';

    public function submit(): void
    {
        $this->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        // Staff authentication and role authorization will be connected after
        // the staff role/permission implementation is ready.
        session()->flash('login_notice', 'Form tervalidasi. Autentikasi admin belum diaktifkan.');
    }

    public function render()
    {
        return view('livewire.staff.admin-login')
            ->layout('layouts.exam', ['title' => 'Login Admin']);
    }
}
