@extends('layouts.layoutKinerja')

@section('content')
<style>
    .profile-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .profile-title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        color: #00452C;
        margin-bottom: 20px;
    }

    .profile-image {
        display: block;
        max-width: 100%;
        height: auto;
        margin: 0 auto 20px;
        border-radius: 8px;
    }

    .profile-description {
        font-size: 16px;
        line-height: 1.6;
        color: #333;
        text-align: justify;
    }
</style>

<div class="profile-container">
    <!-- Judul -->
    <h1 class="profile-title">Nama Daerah</h1>

    <!-- Foto -->
    <img src="{{ asset('images/nama_daerah.jpg') }}" alt="Foto Nama Daerah" class="profile-image">

    <!-- Deskripsi -->
    <p class="profile-description">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
</div>
@endsection
