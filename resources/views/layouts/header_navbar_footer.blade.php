<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI Terap - BBPSIP</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            background-color: #009144;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1000;
        }

        .logo {
            width: 180px;
            height: auto;
            margin-right: 20px;
        }

        .navbar {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-left: auto;
            margin-right: auto;
            align-items: center;
            position: relative;
        }

        .navbar a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 400;
            position: relative;
            padding: 10px 15px;
            transition: color 0.3s ease, font-weight 0.3s ease;
            text-align: center;
            display: inline-block;
        }

        .navbar a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 3px;
            background-color: #ffffff;
            left: 0;
            bottom: -5px;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .navbar a:hover {
            color: #ffffff;
        }

        .navbar a:hover::after {
            transform: scaleX(1);
        }

        .navbar a.active {
            font-weight: 700;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #009144;
            min-width: 160px;
            z-index: 1;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: white;
            padding: 10px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #007739;
        }

        .hero-section {
            background-image: url('/assets/img/bsip_depan.png');
            background-size: cover;
            background-position: center;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            margin-bottom: 50px;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.5rem;
        }

        .footer {
            background-color: #006400;
            padding-bottom: 40px;
            overflow: visible;
            position: relative;
            color: white;
        }

        footer .contact-info p a {
            text-decoration: none;
        }

        footer .social-links {
            margin-top: 10px;
        }

        footer .social-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        footer .social-links a:hover {
            text-decoration: underline;
        }

        .card {
            border-radius: 10px;
            padding: 2px;
            border-width: 0.5px !important;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 100, 0, 0.2);
            border-color: #00640025 !important;
            border-width: 0.5px !important;
        }

        .btn-outline-light-daftar {
            color: #006400;
            border-width: 0.5px;
            border-color: #006400;
        }

        .btn-outline-light-daftar:hover {
            background-color: #006400;
            color: white;
        }

        .btn-outline-light-masuk {
            background-color: #006400;
            color: white;
        }

        .btn-outline-light-masuk:hover {
            background-color: #006400;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <img src="/assets/img/logo_light.webp" alt="Logo" class="logo">
            <nav class="navbar">
                <a class="nav-link {{ request()->routeIs('beranda_kinerja') ? 'active' : '' }}" href="{{ route('beranda_kinerja') }}">Beranda</a>
                <a class="nav-link {{ request()->routeIs('identifikasi_beranda') ? 'active' : '' }}" href="{{ route('identifikasi_beranda') }}">Identifikasi</a>
                <div class="dropdown">
                    <a class="nav-link {{ request()->routeIs('diseminasi.index') ? 'active' : '' }}" href="#">Diseminasi SIP</a>
                    <div class="dropdown-content">
                        <a class="{{ request()->routeIs('diseminasi.peserta') ? 'active' : '' }}" href="{{ route('diseminasi.peserta') }}">Diseminasi Peserta</a>
                        <a class="{{ request()->routeIs('diseminasi.sip_sub_sektor') ? 'active' : '' }}" href="{{ route('diseminasi.sip_sub_sektor') }}">SIP per Sub Sektor</a>
                    </div>
                </div>
                <a class="nav-link" href="#">Pendampingan</a>
            </nav>
        </div>
    </header>

    <div style="margin-top: 80px;">
        @yield('content')
    </div>

    {{-- OMBAK --}}
    <svg viewBox="0 0 120 28">
        <defs>
            <mask id="xxx">
                <circle cx="7" cy="12" r="40" fill="#fff" />
            </mask>

            <filter id="goo">
                <feGaussianBlur in="SourceGraphic" stdDeviation="2" result="blur" />
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 13 -9" result="goo" />
                <feBlend in="SourceGraphic" in2="goo" />
            </filter>

            <path id="wave" d="M 0,10 C 30,10 30,15 60,15 90,15 90,10 120,10 150,10 150,15 180,15 210,15 210,10 240,10 v 28 h -240 z" />
        </defs>

        <use id="wave3" class="wave" xlink:href="#wave" x="0" y="-2"></use>
        <use id="wave2" class="wave" xlink:href="#wave" x="0" y="0"></use>

        <a href="#top" class="topball">
            <circle class="ball" cx="110" cy="8" r="4" stroke="none" stroke-width="0" fill="white" />
            <g class="arrow">
                <polyline points="108,8 110,6 112,8" fill="none" />
                <polyline points="110,6 110,10.5" fill="none" />
            </g>
        </a>

        <g class="gooeff">
            <circle class="drop drop1" cx="20" cy="2" r="1.8" />
            <circle class="drop drop2" cx="25" cy="2.5" r="1.5" />
            <circle class="drop drop3" cx="16" cy="2.8" r="2.2" />
        </g>
    </svg>

    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="text-white"><strong>Hubungi Kami</strong></p>
                            <p><a href="tel:+6285153001224" class="text-white">+62 851-5300-1224</a></p>
                            <p><a href="mailto:info@si-terap.com" class="text-white">info@si-terap.com</a></p>
                        </div>
                        <div class="col-md-4">
                            <p class="text-white"><strong>Ikuti Kami</strong></p>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        var map = L.map('map').setView([-6.1751, 106.8650], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    </script>
</body>
</html>
