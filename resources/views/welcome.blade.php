<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#053866">
    <meta name="description" content="SATu — Sistem Asesmen Terpadu untuk pelaksanaan ujian sekolah.">
    <title>SATu — Sistem Asesmen Terpadu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --satu-primary: #053866;
            --satu-primary-dark: #032849;
            --satu-secondary: #00b3b8;
            --satu-secondary-soft: #e4fafa;
            --satu-ink: #18334b;
            --satu-muted: #61758a;
        }

        body {
            min-height: 100vh;
            color: var(--satu-ink);
            background:
                radial-gradient(ellipse at 88% 12%, rgba(0, 179, 184, .12), transparent 31rem),
                radial-gradient(ellipse at 8% 90%, rgba(5, 56, 102, .07), transparent 30rem),
                #f7fafc;
        }

        .navbar { background: rgba(255,255,255,.88); backdrop-filter: blur(12px); }
        .brand-mark {
            color: var(--satu-primary);
            font-size: 1.8rem;
            font-weight: 900;
            letter-spacing: -.08em;
            line-height: 1;
        }
        .brand-mark .accent { color: var(--satu-secondary); }
        .brand-subtitle { color: var(--satu-muted); font-size: .68rem; letter-spacing: .12em; }
        .hero { min-height: calc(100vh - 145px); }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            padding: .5rem .85rem;
            border: 1px solid rgba(0,179,184,.24);
            border-radius: 999px;
            color: var(--satu-primary);
            background: var(--satu-secondary-soft);
            font-size: .82rem;
            font-weight: 700;
        }
        .eyebrow-dot {
            width: .5rem;
            height: .5rem;
            border-radius: 50%;
            background: var(--satu-secondary);
        }
        .hero-title {
            max-width: 760px;
            color: var(--satu-primary-dark);
            font-size: clamp(2.6rem, 6vw, 4.7rem);
            font-weight: 850;
            letter-spacing: -.055em;
            line-height: 1.06;
        }
        .hero-title .accent { color: var(--satu-secondary); }
        .hero-copy { max-width: 590px; color: var(--satu-muted); font-size: clamp(1rem, 1.5vw, 1.15rem); line-height: 1.85; }
        .btn-satu {
            --bs-btn-color: #fff;
            --bs-btn-bg: var(--satu-primary);
            --bs-btn-border-color: var(--satu-primary);
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: var(--satu-primary-dark);
            --bs-btn-hover-border-color: var(--satu-primary-dark);
            --bs-btn-active-bg: var(--satu-primary-dark);
            --bs-btn-active-border-color: var(--satu-primary-dark);
            padding: .9rem 1.5rem;
            border-radius: .85rem;
            box-shadow: 0 .8rem 1.6rem rgba(5,56,102,.16);
            font-weight: 700;
        }
        .hero-visual {
            position: relative;
            display: grid;
            min-height: 340px;
            place-items: center;
        }
        .visual-glow {
            position: absolute;
            width: min(82%, 360px);
            aspect-ratio: 1;
            border-radius: 50%;
            background: linear-gradient(145deg, rgba(0,179,184,.16), rgba(5,56,102,.08));
            filter: blur(2px);
        }
        .visual-card {
            position: relative;
            width: min(100%, 390px);
            padding: 2rem;
            border: 1px solid rgba(255,255,255,.85);
            border-radius: 1.6rem;
            background: rgba(255,255,255,.9);
            box-shadow: 0 1.5rem 4rem rgba(5,56,102,.12);
            transform: rotate(1.5deg);
        }
        .visual-symbol {
            display: grid;
            width: 76px;
            height: 76px;
            place-items: center;
            border-radius: 1.3rem;
            background: var(--satu-primary);
            color: #fff;
            font-size: 2rem;
            font-weight: 900;
            letter-spacing: -.08em;
        }
        .visual-symbol span { color: var(--satu-secondary); }
        .visual-line { height: 9px; border-radius: 99px; background: #eaf0f5; }
        .visual-line.short { width: 54%; }
        .visual-line.medium { width: 76%; }
        .visual-chip {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .55rem .8rem;
            border-radius: .7rem;
            background: var(--satu-secondary-soft);
            color: var(--satu-primary);
            font-size: .8rem;
            font-weight: 700;
        }
        footer { color: var(--satu-muted); font-size: .82rem; }
        @media (max-width: 767.98px) {
            .hero { min-height: auto; }
            .hero-visual { min-height: 290px; }
            .visual-card { padding: 1.5rem; }
        }
        @media (prefers-reduced-motion: no-preference) {
            .visual-card { animation: float-in .7s ease-out both; }
            @keyframes float-in {
                from { opacity: 0; transform: translateY(14px) rotate(1.5deg); }
                to { opacity: 1; transform: translateY(0) rotate(1.5deg); }
            }
        }
    </style>
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
                                <div class="h4 fw-bold mb-1" style="color:var(--satu-primary)">SATu</div>
                                <div class="small text-secondary">Sistem Asesmen Terpadu</div>
                            </div>
                        </div>
                        <div class="visual-line medium mb-3"></div>
                        <div class="visual-line mb-3"></div>
                        <div class="visual-line short mb-4"></div>
                        <div class="d-flex align-items-center justify-content-between gap-2">
                            <span class="visual-chip"><span class="eyebrow-dot"></span> Siap mengikuti ujian</span>
                            <span class="small fw-bold" style="color:var(--satu-primary)">SATu</span>
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
