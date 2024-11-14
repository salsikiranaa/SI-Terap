@extends('layouts.header_navbar_footer')

@section('content')
<nav class="navbar">
    <span>Ini Beranda</span> <!-- Menampilkan teks "Ini Beranda" tanpa link -->

    <li class="nav-item {{ request()->routeIs('identifikasi_beranda') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('identifikasi_beranda') }}">Identifikasi</a>
    </li>

    <a href="#">Diseminasi SIP</a>
    <a href="#">Link Lainnya</a>
</nav>

@endsection
