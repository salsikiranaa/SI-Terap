@php
    use App\Models\CMS;
    use App\Models\Social;
    $cms = CMS::first();
    $social = Social::get();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $cms->app_name }} - {{ $cms->institute }}</title>
    
    <!-- CSRF Token untuk SweetAlert -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            box-sizing: border-box;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between; 
            padding: 15px 30px;
            background-color: #009144; 
            color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); 
            position: relative;
            z-index: 1000; 
            top: 0;
            left: 0;
            width: 100%;
        }

        .logo {
            width: 150px; 
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
            margin-bottom: 0;
            padding-bottom: 0;
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

        .navbar a:hover {
            color: #C48F00; 
        }

        .navbar a.active,
        .navbar a.nav-link.active {
            color: #FEDF00 !important;
            font-weight: 700;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #ffffff; /* Background putih */
            min-width: 160px;
            z-index: 1001;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 5px;
            overflow: hidden;
            top: 100%;
            left: 0;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: #009144 !important; /* Font hijau */
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-weight: 400;
        }

        .dropdown-content a:hover {
            background-color: #f8f9fa; /* Background abu-abu muda saat hover */
            color: #007739 !important; /* Hijau lebih gelap saat hover */
        }

        .dropdown-content a.active {
            background-color: #e8f5e8; /* Background hijau muda untuk item aktif */
            color: #006400 !important; /* Hijau gelap untuk item aktif */
            font-weight: 600;
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
            background-color: #009144;
            color: white;
            padding-top: 50px;
            padding-bottom: 0;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
        }

        .footer h5 {
            font-size: 1.25rem;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }

        .footer h5::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 40px;
            height: 3px;
            background: #ffffff;
        }

        .footer .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .footer .contact-item:hover {
            transform: translateX(5px);
        }

        .footer .contact-icon {
            font-size: 18px;
            margin-right: 15px;
            color: white;
            flex-shrink: 0;
        }

        .footer .contact-text {
            line-height: 1.4;
        }

        .footer .contact-text a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer .contact-text a:hover {
            color: rgba(255, 255, 255, 0.8);
        }

        .footer iframe {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .footer iframe:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .footer .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .footer .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            font-size: 18px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .footer .social-links a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
            color: #ffffff;
        }

        .footer-bottom {
            background: rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            margin-top: 40px;
        }

        @import url("https://fonts.googleapis.com/css?family=Lato:400,400i,700");

        svg {
            width:100%;
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
        
        .btn-outline-light-logout {
            color: white; 
            border-width: 0.5px;
            border-color: white;
        }
        
        .btn-outline-light-logout:hover {
            background-color: white;
            color: #006400;
        }

        .btn-outline-light-masuk{
            background-color: #006400;
            color: white;
        }

        .btn-outline-light-masuk:hover{
            background-color: #006400;
            color: white;
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
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="{{ route('dashboard-lp2tp') }}">
                <img src="/assets/img/logo_bsip.png" alt="Logo" style="height: 50px;">
            </a>
            <nav class="navbar">
                <a class="nav-link {{ request()->is('dashboard-lp2tp') ? 'active' : '' }}" href="{{ route('dashboard-lp2tp') }}">Beranda</a>
                <a class="{{ request()->routeIs('lp2tp.galeri') ? 'active' : '' }}" href="{{ route('lp2tp.galeri') }}">Profil</a>
                <div class="dropdown">
                    <a class="nav-link {{ request()->routeIs('aset.index') ? 'active' : '' }}" href="#">Aset</a>
                    <div class="dropdown-content">
                        <a class="{{ request()->routeIs('aset.tanah') ? 'active' : '' }}" href="{{ route('aset.tanah') }}">Tanah</a>
                        {{-- <a class="{{ request()->routeIs('aset.gedung') ? 'active' : '' }}" href="{{ route('aset.gedung') }}">Gedung</a>
                        <a class="{{ request()->routeIs('aset.lab') ? 'active' : '' }}" href="{{ route('aset.lab') }}">Laboratorium</a>
                        <a class="{{ request()->routeIs('aset.rumah_negara') ? 'active' : '' }}" href="{{ route('aset.rumah_negara') }}">Rumah Negara</a> --}}
                        <a class="{{ request()->routeIs('aset.alat_mesin') ? 'active' : '' }}" href="{{ route('aset.alat_mesin') }}">Peralatan & Mesin</a>
                    </div>
                </div>
                <a class="{{ request()->routeIs('lp2tp.pemanfaatan_kp') ? 'active' : '' }}" href="{{ route('lp2tp.pemanfaatan_kp') }}">Pemanfaatan KP</a>
            </nav>

            <div>
                @if (auth()->user())
                    <div class="dropdown">
                        <button class="bg-transparent border-0 dropdown-toggle" style="color: #fff;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <a href="{{ route('auth.register.view') }}" class="btn btn-outline-light mr-2">Daftar</a>
                    <a href="{{ route('auth.login.view') }}" class="btn mr-2" style="color: #006400; background-color:white">Masuk</a>
                @endif
            </div>
        </div>
    </header>

    <div>

        @yield('content')
    </div>

   
    
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Kolom Map -->
                <div class="col-md-6 mb-4">
                    <div class="mt-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.5443994375355!2d106.78557271018322!3d-6.5790339933869735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5311ad80031%3A0xae42de3ba17aceb7!2sBalai%20Besar%20Penerapan%20Standar%20Instrumen%20Pertanian%20(BBPSIP)!5e0!3m2!1sen!2sid!4v1722608683905!5m2!1sen!2sid"
                            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                
                <!-- Kolom Kontak -->
                <div class="col-md-6 mb-4">
                    <div class="mt-4">
                        <h5 class="fw-bold text-white">Hubungi Kami</h5>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-text">
                                <a href="tel:+6202518531727">{{ $cms->contact_1 }}</a>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="contact-text">
                                <a href="https://wa.me/{{ $cms->contact_2 }}">{{ $cms->contact_2 }}</a>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-text">
                                <a href="mailto:{{ $cms->email }}">{{ $cms->email }}</a>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-text">
                                {{ $cms->address }}
                            </div>
                        </div>
                        
                        <div class="social-links">
                            @foreach ($social as $sc)
                                <a href="{{ $sc->url }}" target="_blank" title="{{ ucfirst($sc->name) }}">
                                    <i class="fab fa-{{ $sc->name }}"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="mb-0">&copy; {{ date('Y') }} {{ $cms->app_name }} - {{ $cms->institute }}. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- SweetAlert Global Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto handle session flash messages jadi popup
            @if(session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonColor: '#28a745',
                    confirmButtonText: 'OK',
                    timer: 5000,
                    timerProgressBar: true,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: 'OK'
                });
            @endif

            @if(session('warning'))
                Swal.fire({
                    title: 'Peringatan!',
                    text: '{{ session('warning') }}',
                    icon: 'warning',
                    confirmButtonColor: '#ffc107',
                    confirmButtonText: 'OK'
                });
            @endif

            @if(session('info'))
                Swal.fire({
                    title: 'Informasi!',
                    text: '{{ session('info') }}',
                    icon: 'info',
                    confirmButtonColor: '#17a2b8',
                    confirmButtonText: 'OK'
                });
            @endif

            @if($errors->any())
                let errorMessages = '';
                @foreach($errors->all() as $error)
                    errorMessages += '• {{ $error }}\n';
                @endforeach
                
                Swal.fire({
                    title: 'Validation Error!',
                    text: errorMessages,
                    icon: 'error',
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: 'OK'
                });
            @endif
        });

        // Global function untuk konfirmasi delete (bisa dipake di mana aja)
        function confirmDelete(url, title = 'Apakah Anda yakin?', text = 'Data yang dihapus tidak dapat dikembalikan!') {
            return Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                showClass: {
                    popup: 'animate__animated animate__zoomIn'
                },
                hideClass: {
                    popup: 'animate__animated animate__zoomOut'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Create and submit form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.style.display = 'none';
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                    form.appendChild(csrfToken);
                    
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
                return result.isConfirmed;
            });
        }

        // Global functions untuk show notifikasi manual
        function showSuccess(message, title = 'Berhasil!') {
            Swal.fire({
                title: title,
                text: message,
                icon: 'success',
                confirmButtonColor: '#28a745',
                timer: 4000,
                timerProgressBar: true
            });
        }

        function showError(message, title = 'Error!') {
            Swal.fire({
                title: title,
                text: message,
                icon: 'error',
                confirmButtonColor: '#dc3545'
            });
        }

        function showWarning(message, title = 'Peringatan!') {
            Swal.fire({
                title: title,
                text: message,
                icon: 'warning',
                confirmButtonColor: '#ffc107'
            });
        }

        function showInfo(message, title = 'Informasi!') {
            Swal.fire({
                title: title,
                text: message,
                icon: 'info',
                confirmButtonColor: '#17a2b8'
            });
        }

        // Keep original hideAlert function for compatibility
        const hideAlert = (e) => {
            e.style.display = 'none';
        }
    </script>
</body>
</html>