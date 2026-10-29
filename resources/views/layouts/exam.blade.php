<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'SATu' }} - {{ config('app.name', 'SATu') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        :root { --bs-primary: #087f8c; --bs-primary-rgb: 8,127,140; }
        body { min-height: 100vh; background: radial-gradient(circle at 10% 10%, #e4f7f7 0, transparent 32%), #f5f8fa; color: #16333b; }
        .min-vh-75 { min-height: 75vh; }
        .satu-mark { display:flex; align-items:center; justify-content:center; gap:.12rem; width:58px; height:58px; border-radius:17px; background:#073e49; color:#fff; font-weight:800; font-size:1.5rem; letter-spacing:-.08em; box-shadow:0 8px 22px rgba(7,62,73,.18); }
        .satu-mark span { color:#50d7cc; font-size:1.35rem; }
        .form-control:focus { border-color:#36a9b0; box-shadow:0 0 0 .25rem rgba(8,127,140,.14); }
        .btn-primary { --bs-btn-bg:#087f8c; --bs-btn-border-color:#087f8c; --bs-btn-hover-bg:#066b76; --bs-btn-hover-border-color:#066b76; --bs-btn-active-bg:#055a63; }
        .card { box-shadow:0 1rem 2.5rem rgba(18,55,66,.07)!important; }
    </style>
    @livewireStyles
</head>
<body>
    {{ $slot }}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    @livewireScripts
</body>
</html>
