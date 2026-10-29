<?php

namespace App\Livewire\Exam;

use Livewire\Component;

class Login extends Component
{
    public string $examCode = '';
    public string $username = '';
    public string $password = '';

    public function submit(): void
    {
        $this->validate([
            'examCode' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:80'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        // Authentication is intentionally not enabled until the approved
        // exams/exam_assignments schema and credential service are implemented.
        session()->flash('login_notice', 'Form sudah tervalidasi. Autentikasi peserta belum diaktifkan karena tabel dan layanan kredensial ujian masih dalam tahap implementasi.');
    }

    public function render()
    {
        return view('livewire.exam.login')
            ->layout('layouts.exam', ['title' => 'Masuk Peserta']);
    }
}
