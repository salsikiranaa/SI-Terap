@extends('layouts.layoutKinerja')

@section('content')
<div class="bg-gray-100 min-h-screen py-6 px-4">
    <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Gambar BSIP -->
        <img 
            src="{{ asset('images/bsip-sample.jpg') }}" 
            alt="Foto BSIP" 
            class="w-full h-48 object-cover">
        
        <!-- Konten Detail -->
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Nama BSIP Daerah</h2>
            <p class="text-gray-600 text-sm mb-4">
                <strong>Lokasi:</strong> Jl. Contoh Alamat, Kota, Provinsi
            </p>
            <p class="text-gray-600 leading-relaxed mb-6">
                Deskripsi singkat mengenai BSIP. Misalnya, fokus utama dan layanan yang diberikan oleh BSIP di daerah tersebut.
            </p>

            <!-- Tombol Navigasi -->
            <div class="flex justify-between items-center">
                <a href="#" class="text-white bg-green-600 hover:bg-green-500 px-4 py-2 rounded shadow">
                    Kontak
                </a>
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-gray-800">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
