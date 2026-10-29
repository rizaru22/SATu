<?php

namespace App\Livewire\Staff;

use Livewire\Component;

class ProctorLogin extends Component
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
        session()->flash('login_notice', 'Form tervalidasi. Autentikasi pengawas belum diaktifkan.');
    }

    public function render()
    {
        return view('livewire.staff.proctor-login')
            ->layout('layouts.exam', ['title' => 'Login Pengawas']);
    }
}
