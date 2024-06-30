<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title logo -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-tangerang.svg') }}" />
    <title>Stunting Checker</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav>
        <div class="logo">
            <img src="{{ asset('images/logo-tangerang.svg') }}" alt="Logo Tangerang">
        </div>
        <div class="nav-title">Kelurahan Tanah Tinggi</div>
        <div class="nav-links">
             @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                    <a href="{{ url('/profile') }}">Profile</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>
    <div class="container">
        <div class="hero">
            <div class="hero-text">
                <h2>Aplikasi Pengecekan Stunting</h2>
                <p>Aplikasi ini adalah aplikasi pengecekan status Stunting Anak yang disediakan oleh Kelurahan Tanah Tinggi untuk mendukung penurunan angka stunting pada anak di Indonesia.</p>
                <a href="{{ route('dashboard') }}">Mulai Hitung</a>
            </div>
            <img src="{{ asset('images/anak-sehat.png') }}" alt="Health Image">
        </div>
    </div>
    <footer>
        <p>© 2024 Universitas Muhammadiyah Tangerang</p>
    </footer>
</body>
</html>
