<main class="auth-shell">
    <div class="auth-layout">
        <header class="auth-heading">
            <div class="auth-brand-mark" aria-hidden="true">S<span>A</span></div>
            <p class="auth-eyebrow text-primary">Sistem Asesmen Terpadu</p>
            <div class="mb-2"><span class="auth-role-badge bg-info-subtle text-primary">Akses Staf</span></div>
            <h1 class="auth-title">Login Staf</h1>
            <p class="auth-description text-secondary">Satu pintu masuk untuk administrator dan proktor SATu.</p>
        </header>
        <section class="auth-card card">
            <div class="card-body">
                @if (session('login_notice'))
                    <div class="alert alert-info small" role="status">{{ session('login_notice') }}</div>
                @endif
                <form wire:submit="submit" novalidate>
                    <div class="mb-3">
                        <label for="staff-email" class="form-label fw-semibold">Email akun</label>
                        <input id="staff-email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                            wire:model="email" autocomplete="username" placeholder="nama@sekolah.sch.id" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="staff-password" class="form-label fw-semibold">Password</label>
                        <input id="staff-password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                            wire:model="password" autocomplete="current-password" placeholder="Masukkan password" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100 auth-submit" wire:loading.attr="disabled">
                        <span wire:loading.remove>Masuk</span>
                        <span wire:loading>Memeriksa...</span>
                    </button>
                </form>
            </div>
        </section>
        <p class="auth-note text-secondary">Akses administrator atau proktor ditentukan oleh hak akses akun setelah autentikasi diterapkan.</p>
        <div class="text-center"><a class="auth-back" href="{{ route('home') }}">← Kembali ke halaman utama</a></div>
    </div>
</main>
