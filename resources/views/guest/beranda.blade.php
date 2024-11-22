<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI TERAP - BBPSIP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
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
            color: white;
            padding-bottom: 40px;
            overflow: visible;
            position: relative;
        }

        @import url("https://fonts.googleapis.com/css?family=Lato:400,400i,700");

        svg {
            width:100%;
        }

        .arrow {
            stroke-width: .3px;
            stroke:yellow;
        }

        .topball {
            animation: ball 1.5s ease-in-out;
            animation-iteration-count:infinite;
            animation-direction: alternate;
            animation-delay: 0.3s;
            cursor:pointer;
        }

        .wave {
            animation: wave 3s linear;
            animation-iteration-count:infinite;
            fill: #006400;
        }

        .drop {
            fill: transparent;
            animation: drop 5s ease infinite normal;
            stroke: #006400;
            stroke-width:0.5;
            opacity:.6; 
            transform: translateY(80%);
        }

        .drop1 {
            transform-origin: 20px 3px;
        }

        .drop2 {
            animation-delay: 3s;
            animation-duration:3s;
            transform-origin: 25px 3px;
        }

        .drop3 {
            animation-delay: -2s;
            animation-duration:3.4s;
            transform-origin: 16px 3px;
        }

        .gooeff {
            filter: url(#goo);
        }

        #wave2 {
            animation-duration:5s;
            animation-direction: reverse;
            opacity: .6
        }

        #wave3 {
            animation-duration: 7s;
            opacity:.3;
        }

        @keyframes drop {
            0% {
                transform: translateY(80%); 
                opacity:.6; 
            }
            80% {
                transform: translateY(80%); 
                opacity:.6; 
            }
            90% { 
                transform: translateY(10%) ; 
                opacity:.6; 
            }
            100% { 
                transform: translateY(0%) scale(1.5);  
                stroke-width:0.2;
                opacity:0; 
            }
        }

        @keyframes wave {
            to {transform: translateX(-100%);}
            }
            @keyframes ball {
            to {transform: translateY(20%);}
        }

        .header {
            background-color: white;
            color: white;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            z-index: 20;
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        footer .contact-info p a {
            color: white;
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
        
        .card{
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

        .btn-outline-light-masuk{
            background-color: #006400;
            color: white;
        }

        .btn-outline-light-masuk:hover{
            background-color: #006400;
            color: white;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="container">
            <a href=""><img src="/assets/img/logo_green.png" alt="Logo" style="height: 50px;"></a>
            <div>
                @if (auth()->user())
                    {{-- <div style="color: #006400">{{ auth()->user()->name }}</div> --}}
                    <div class="dropdown">
                        <button class="bg-transparent border-0 dropdown-toggle" style="color: #006400;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>
                    
                        <ul class="dropdown-menu">
                            @if (auth()->user()->role_id == 1)
                                <li><a class="dropdown-item" href="{{ route('manage.dashboard') }}" style="color: #006400">Dashboard</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('auth.logout') }}" style="color: #006400">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('auth.register.view') }}" class="btn btn-outline-light-daftar mr-2">Daftar</a>
                    <a href="{{ route('auth.login.view') }}" class="btn btn-outline-light-masuk mr-2">Masuk</a>
                @endif
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero">
            <h1>SI TERAP</h1>
            <p>Portal Sistem Informasi Terpadu Balai Besar Penerapan Standar Instrumen Pertanian</p>
        </div>
    </div>

    <!-- Section Layanan -->
    <section class="services py-5">
        <div class="container text-center">
            <h2 class="mb-5" style="color: green"><b>Layanan</b></h2>
            <div class="row d-flex justify-content-center">
                <div class="col-md-2">
                    <a href="{{route('beranda_kinerja')}}" style="text-decoration: none">
                        <div class="card border" style="border: 10px">
                            <img src="https://img.freepik.com/free-vector/statistical-data-research-company-performance-indicators-return-investment-percentage-ratio-indexes-fluctuation-significative-change_335657-1165.jpg?t=st=1730187597~exp=1730191197~hmac=424ad0cd8b99667514e8edd11b892ed3ad446e241525bdda6789f6c64167f256&w=740" alt="Kinerja Kegiatan" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Kinerja Kegiatan</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{route('beranda-Lab')}}" style="text-decoration: none">
                        <div class="card border">
                            <img src="https://img.freepik.com/free-vector/business-audit-financial-specialist-cartoon-character-with-magnifier-examination-statistical-graphic-information-statistics-diagram-chart_335657-834.jpg?t=st=1730188656~exp=1730192256~hmac=4e5713040e496c8a7f0130c0651f08f1fbb0e456055e79d4e4d5cbbb4adfd42f&w=740" alt="Lab Pengujian" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Lab Pengujian <br></h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{route('beranda_pengelolaan')}}" style="text-decoration: none">
                        <div class="card border">
                            <img src="https://img.freepik.com/free-vector/bug-fixing-software-testing-computer-virus-searching-tool-devops-web-optimization-antivirus-app-magnifier-cogwheel-monitor-design-element_335657-211.jpg?t=st=1730187126~exp=1730190726~hmac=66b3253705fcec65c36d963573a90c2fae0a167433173ae3ad9caee35e6ce6cc&w=740" alt="Perbenihan" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Perbenihan</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{route('dashboard-lp2tp')}}" style="text-decoration: none">
                        <div class="card border">
                            <img src="https://img.freepik.com/free-vector/customer-self-service-abstract-concept-illustration-e-support-system-electronic-proactive-customer-online-assistance-faqs-knowledge-base-representative-free-shop_335657-46.jpg?t=st=1730188492~exp=1730192092~hmac=55fb09f5873e946b328714bdf21ecfbbc27f923aa61231d0886288681d96a534&w=740" alt="IP2SIP" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">IP2SIP</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" style="text-decoration: none">
                        <div class="card border">
                            <img src="https://img.freepik.com/free-vector/dashboard-analytics-computer-performance-evaluation-chart-screen-statistics-analysis-infographic-assessment-business-report-display-isolated-concept-metaphor-illustration_335657-1149.jpg?t=st=1730188574~exp=1730192174~hmac=062d414ad7f4ba7ea2bff35402cca9842a482fe9ff3607cbf442e81a40e3b083&w=740" alt="Direktori SDM Penyuluh" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Direktori SDM Penyuluh</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- OMBAK --}}
    <svg viewBox="0 0 120 28">
        <defs> 
            <mask id="xxx">
                <circle cx="7" cy="12" r="40" fill="#fff" />
            </mask>

            <filter id="goo">
                <feGaussianBlur in="SourceGraphic" stdDeviation="2" result="blur" />
                <feColorMatrix in="blur" mode="matrix" values="
                    1 0 0 0 0  
                    0 1 0 0 0  
                    0 0 1 0 0  
                    0 0 0 13 -9" result="goo" />
                <feBlend in="SourceGraphic" in2="goo" />
            </filter>

            <path id="wave" d="M 0,10 C 30,10 30,15 60,15 90,15 90,10 120,10 150,10 150,15 180,15 210,15 210,10 240,10 v 28 h -240 z" />
        </defs> 

        <use id="wave3" class="wave" xlink:href="#wave" x="0" y="-2" ></use> 
        <use id="wave2" class="wave" xlink:href="#wave" x="0" y="0" ></use>
        
        <a href="#top" class="topball">
            <circle class="ball" cx="110" cy="8" r="4" stroke="none" stroke-width="0" fill="red" />
                <g class="arrow">
                <polyline class="" points="108,8 110,6 112,8" fill="none"  />
                <polyline class="" points="110,6 110,10.5" fill="none"  />
                </g>
        </a>

        <g class="gooeff">
        <circle class="drop drop1" cx="20" cy="2" r="1.8"  />
        <circle class="drop drop2" cx="25" cy="2.5" r="1.5"  />
        <circle class="drop drop3" cx="16" cy="2.8" r="1.2"  />
        <use id="wave1" class="wave" xlink:href="#wave" x="0" y="1" />
        </g>
    </svg>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.5443994375355!2d106.78557271018322!3d-6.5790339933869735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5311ad80031%3A0xae42de3ba17aceb7!2sBalai%20Besar%20Penerapan%20Standar%20Instrumen%20Pertanian%20(BBPSIP)!5e0!3m2!1sen!2sid!4v1722608683905!5m2!1sen!2sid" width="100%" height="250" style="border:0; border-radius: 5px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-6">
                    <div class="contact-info">
                        <p><b>KONTAK</b></p>
                        <p><a href="tel:+6202518531727"></a>(0251) 8531727 | WA : <a href="https://wa.me/085282828696">085282828696</a></p>
                        <p>Email: <a href="mailto:bbpsip@apps.pertanian.go.id">bbpsip@apps.pertanian.go.id</a></p>
                        <p>Jl. Tentara Pelajar No.10, RT.04/RW.07, Ciwaringin, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16124</p>
                        
                        <p><a href="https://bbpsip.bsip.pertanian.go.id" target="_blank">https://bbpsip.bsip.pertanian.go.id</a></p>
                        <div class="social-links">
                            <a href="https://www.facebook.com/BSIPPenerapan/" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.youtube.com/@bsippenerapan" target="_blank"><i class="fab fa-youtube"></i></a>
                            <a href="https://instagram.com/bsippenerapan" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://twitter.com/bsippenerapan" target="_blank"><i class="fab fa-x-twitter"></i></a>
                            <a href="https://tiktok.com/@bsippenerapan" target="_blank"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>