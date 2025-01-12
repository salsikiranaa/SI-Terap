@extends('layouts.layoutKinerja')

@section('content')
<style>
    /* Container utama */
    .profile-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        color: #00452C; /* Warna teks default hijau */
    }

    /* Judul */
    .profile-title {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 20px;
        letter-spacing: 1.5px;
        color: #00452C; /* Warna hijau pada judul */
    }

    /* Garis dekorasi judul */
    .profile-title::after {
        content: '';
        width: 50px;
        height: 3px;
        background: #00452C; /* Warna hijau pada garis dekorasi */
        display: block;
        margin: 10px auto 0;
        border-radius: 1.5px;
    }

    /* Gambar */
    .profile-image {
        display: block;
        max-width: 100%;
        height: auto;
        margin: 20px auto;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease;
    }

    .profile-image:hover {
        transform: scale(1.05);
    }

    /* Deskripsi */
    .profile-description {
        font-size: 18px;
        line-height: 1.8;
        color: #00452C; /* Warna hijau pada teks deskripsi */
        text-align: justify;
        margin-top: 15px;
    }

    /* Tombol */
    .profile-button {
        display: inline-block;
        padding: 12px 25px;
        background-color: #fff;
        color: #00452C; /* Warna hijau pada tombol */
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 8px;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin-top: 20px;
        text-align: center;
    }

    .profile-button:hover {
        background-color: #78C2AD;
        color: #00452C; /* Warna hijau tetap pada tombol saat hover */
    }
</style>

<div class="profile-container">
    <!-- Judul -->
    <h1 class="profile-title">{{ $profile->m_bsip->name }}</h1>

    <!-- Foto -->
    <img src="{{ $profile->image_url }}" alt="Foto Nama Daerah" class="profile-image">

    <!-- Deskripsi -->
    <p class="profile-description">
        {{-- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. --}}
        {{ $profile->description }}
    </p>

    <!-- Tombol -->
    <div style="text-align: center;">
        <a href="#more-info" class="profile-button">Selengkapnya</a>
    </div>
</div>
@endsection
