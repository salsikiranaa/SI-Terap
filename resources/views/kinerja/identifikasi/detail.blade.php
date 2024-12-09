@extends('layouts.layoutKinerja')

@section('content')
<style>
    /* resources/css/custom.css */
    .header-image {
        position: relative;
        width: 100%;
        height: 16rem;
        object-fit: cover;
    }

    .header-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
    }

    .header-title {
        position: absolute;
        bottom: 1rem;
        left: 1rem;
        font-size: 1.875rem; /* text-3xl */
        font-weight: 700;    /* font-bold */
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
    }

    .card-content {
        padding: 2rem;
        gap: 1.5rem; /* space-y-6 */
    }

    .card-text {
        color: #4a5568; /* text-gray-700 */
        font-size: 1.125rem; /* text-lg */
    }

    .card-location {
        color: #2d3748; /* text-gray-800 */
        font-weight: 600;  /* font-semibold */
    }

    .card-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 1rem; /* space-x-4 */
    }

    .button-contact {
        background: #38a169; /* bg-green-600 */
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: background 0.3s ease;
    }

    .button-contact:hover {
        background: #2f855a; /* hover:bg-green-500 */
    }

    .button-back {
        color: #4a5568; /* text-gray-600 */
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .button-back:hover {
        color: #2d3748; /* hover:text-gray-800 */
    }
</style>
<div class="bg-gray-50 min-h-screen py-10 px-6">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Gambar BSIP -->
        <div class="header-image" style="background-image: url('{{ asset('images/bsip-sample.jpg') }}')">
            <div class="header-overlay"></div>
            <h2 class="header-title">Nama BSIP Daerah</h2>
        </div>

        <!-- Konten Detail -->
        <div class="card-content">
            <div class="space-y-4">
                <p class="card-text">
                    <span class="card-location">Lokasi:</span> Jl. Contoh Alamat, Kota, Provinsi
                </p>
                <p class="card-text">
                    Deskripsi singkat mengenai BSIP. Misalnya, fokus utama dan layanan yang diberikan oleh BSIP di daerah tersebut.
                </p>
            </div>

            <!-- Tombol Navigasi -->
            <div class="card-buttons">
                <a href="#" class="button-contact">Kontak</a>
                <a href="{{ url('/') }}" class="button-back">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
