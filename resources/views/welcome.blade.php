<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#053866">
    <meta name="description" content="SATu — Sistem Asesmen Terpadu untuk pelaksanaan ujian sekolah.">
    <title>SATu — Sistem Asesmen Terpadu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/colors.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar border-bottom border-light-subtle">
        <div class="container py-2">
            <a class="navbar-brand d-flex align-items-center gap-3 m-0" href="{{ route('home') }}" aria-label="SATu Beranda">
                <span class="brand-mark">S<span class="accent">A</span>Tu</span>
                <span class="d-flex flex-column">
                    <span class="fw-bold text-dark">SATu</span>
                    <span class="brand-subtitle text-uppercase">Sistem Asesmen Terpadu</span>
                </span>
            </a>
        </div>
    </nav>

    <main class="container hero d-flex align-items-center py-5">
        <div class="row align-items-center g-5 w-100 py-lg-5">
            <div class="col-12 col-lg-7">
                <span class="eyebrow mb-4"><span class="eyebrow-dot"></span> Sistem Asesmen Terpadu</span>
                <h1 class="hero-title mb-4">
                    Selamat datang di <span class="accent">SATu.</span>
                </h1>
                <p class="hero-copy mb-4">
                    Platform ujian sekolah yang membantu peserta mengikuti asesmen secara terarah,
                    tertib, dan terintegrasi. Siapkan kartu peserta Anda sebelum masuk ke ruang ujian.
                </p>
                <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                    <a href="{{ route('exam.login') }}" class="btn btn-satu btn-lg">
                        Login Peserta
                        <span class="ms-2" aria-hidden="true">→</span>
                    </a>
                    <span class="small text-secondary">Gunakan kode ujian dan akun pada kartu peserta.</span>
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="hero-visual" aria-hidden="true">
                    <div class="visual-glow"></div>
                    <div class="visual-card">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="visual-symbol">S<span>A</span></div>
                            <div>
                                <div class="visual-card-title mb-1">SATu</div>
                                <div class="small text-secondary">Sistem Asesmen Terpadu</div>
                            </div>
                        </div>
                        <div class="visual-line medium mb-3"></div>
                        <div class="visual-line mb-3"></div>
                        <div class="visual-line short mb-4"></div>
                        <div class="d-flex align-items-center justify-content-between gap-2">
                            <span class="visual-chip"><span class="eyebrow-dot"></span> Siap mengikuti ujian</span>
                            <span class="visual-card-label">SATu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="container py-4 border-top border-light-subtle">
        <div class="d-flex flex-column flex-sm-row justify-content-between gap-2">
            <span>© {{ date('Y') }} SATu · Sistem Asesmen Terpadu</span>
            <span>Gunakan akun ujian Anda secara bertanggung jawab.</span>
        </div>
    </footer>
</body>
</html>
