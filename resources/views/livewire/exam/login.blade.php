<main class="auth-shell">
    <div class="auth-layout">
        <header class="auth-heading">
            <div class="auth-brand-mark" aria-hidden="true">S<span>A</span></div>
            <p class="auth-eyebrow text-primary">Sistem Asesmen Terpadu</p>
            <h1 class="auth-title">Masuk ke ruang ujian</h1>
            <p class="auth-description text-secondary">Gunakan kode ujian dan kredensial pada kartu peserta.</p>
        </header>

        <section class="auth-card card">
            <div class="card-body">
                @if (session('login_notice'))
                    <div class="alert alert-info small" role="status">{{ session('login_notice') }}</div>
                @endif

                <form wire:submit="submit" novalidate>
                    <div class="mb-3">
                        <label for="examCode" class="form-label fw-semibold">Kode ujian</label>
                        <input id="examCode" type="text" class="form-control form-control-lg text-uppercase @error('examCode') is-invalid @enderror"
                            wire:model="examCode" autocomplete="off" placeholder="Contoh: SAS-2026" required>
                        @error('examCode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <input id="username" type="text" class="form-control form-control-lg @error('username') is-invalid @enderror"
                            wire:model="username" autocomplete="username" placeholder="Username peserta" required>
                        @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                            wire:model="password" autocomplete="current-password" placeholder="Password pada kartu" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100 auth-submit" wire:loading.attr="disabled">
                        <span wire:loading.remove>Masuk ujian</span>
                        <span wire:loading>Memeriksa...</span>
                    </button>
                </form>
            </div>
        </section>
        <p class="auth-note text-secondary">Jaga kerahasiaan username dan password Anda.</p>
        <div class="text-center"><a class="auth-back" href="{{ route('home') }}">← Kembali ke halaman utama</a></div>
    </div>
</main>
