<div class="container py-5">
    <div class="row min-vh-75 align-items-center justify-content-center">
        <div class="col-12 col-md-9 col-lg-5 col-xl-4">
            <div class="text-center mb-4">
                <div class="satu-mark mx-auto mb-3" aria-hidden="true">S<span>1</span></div>
                <p class="text-uppercase small fw-semibold text-primary mb-2">Sistem Aplikasi Ujian</p>
                <h1 class="h3 fw-bold mb-2">Masuk ke ruang ujian</h1>
                <p class="text-secondary mb-0">Gunakan kode ujian dan kredensial pada kartu peserta.</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-4">
                    @if (session('login_notice'))
                        <div class="alert alert-info small" role="status">{{ session('login_notice') }}</div>
                    @endif

                    <form wire:submit="submit" novalidate>
                        <div class="mb-3">
                            <label for="examCode" class="form-label fw-semibold">Kode ujian</label>
                            <input id="examCode" type="text" class="form-control form-control-lg text-uppercase @error('examCode') is-invalid @enderror"
                                wire:model="examCode" autocomplete="off" placeholder="Contoh: SAS-2026" required>
                            @error('examCode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div class="form-text">Masukkan kode yang tercetak pada kartu peserta.</div>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <input id="username" type="text" class="form-control form-control-lg @error('username') is-invalid @enderror"
                                wire:model="username" autocomplete="username" placeholder="Username peserta" required>
                            @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                wire:model="password" autocomplete="current-password" placeholder="Password pada kartu" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold" wire:loading.attr="disabled">
                            <span wire:loading.remove>Validasi data</span>
                            <span wire:loading>Memeriksa...</span>
                        </button>
                    </form>
                </div>
            </div>

            <div class="d-flex align-items-start gap-2 text-secondary small mt-4">
                <span class="badge text-bg-light border mt-1">Info</span>
                <p class="mb-0">Pastikan kode ujian, username, dan password sesuai kartu. Jangan bagikan kredensial kepada peserta lain.</p>
            </div>
            <p class="text-center text-secondary small mt-4 mb-0">SATu · Sistem Aplikasi Ujian</p>
        </div>
    </div>
</div>
