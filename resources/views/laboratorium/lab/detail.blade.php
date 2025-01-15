@extends('layouts.header_navbar_footer_lab')

@section('content')

<div class="container">
    <h1>Detail Laboratorium</h1>

    <style>
        .card {
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header, .card-footer {
            padding: 1rem 1.5rem;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 1.5rem;
        }

        .sections {
            padding: 1rem 1.5rem;
        }

        h1, h2, h3 {
            margin-bottom: 1rem;
        }
        .btn-gr {
    background-color: #006400;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    text-decoration: none;
}

.btn-gr:hover {
    background-color: #004c00; /* Warna lebih gelap saat hover */
}

    </style>

    @php
        $lab = (object)[
            'name' => 'Laboratorium Kimia',
            'jenis_analisis' => 'Kuantitatif',
            'metode_analisis' => 'Titrasi',
            'analisis' => 'Pengukuran kadar asam',
            'kompetensi_personal' => 'Kimia Analitik',
            'nama_pelatihan' => 'Pelatihan Titrasi Asam-Basa',
            'tahun' => 2024
        ];
    @endphp

    <div class="card mt-5">
        <div class="card-header text-center">
            <h3>{{ $lab->name }}</h3>
        </div>
        <div class="d-flex flex-column flex-md-row">
            <div class="col-md-4 d-flex flex-column">
                <img src="https://istscientific.com/wp-content/uploads/2023/10/Top-7-Lab-Supplies-Every-Laboratory-Needs.jpg" class="img-fluid rounded-start" alt="Lab Image">
            </div>
            <div class="col-md-8 d-flex flex-column">
                <div class="card-body">
                    <p><strong>Jenis Analisis:</strong> {{ $lab->jenis_analisis }}</p>
                    <p><strong>Metode Analisis:</strong> {{ $lab->metode_analisis }}</p>
                    <p><strong>Analisis:</strong> {{ $lab->analisis }}</p>
                    <p><strong>Kompetensi Personal:</strong> {{ $lab->kompetensi_personal }}</p>
                    <p><strong>Nama Pelatihan:</strong> {{ $lab->nama_pelatihan }}</p>
                    <p><strong>Tahun:</strong> {{ $lab->tahun }}</p>
                </div>
            </div>
        </div>

        <div class="sections mt-5 d-flex flex-column">
            <div id="about" class="section mb-4">
                <h2>Tentang Laboratorium</h2>
                <p>
                    Laboratorium kami bertujuan untuk mendukung penelitian dan pengembangan di berbagai bidang ilmiah. Kami menyediakan peralatan canggih serta lingkungan kolaboratif bagi mahasiswa, peneliti, dan profesional industri. Selain itu, laboratorium kami sering mengadakan seminar, workshop, dan pelatihan untuk meningkatkan keterampilan peserta dalam bidang penelitian.
                </p>
            </div>
            <div id="facilities" class="section mb-4">
                <h2>Fasilitas</h2>
                <p>
                    Laboratorium kami dilengkapi dengan berbagai fasilitas modern, seperti mikroskop canggih, komputer berkecepatan tinggi, serta perangkat lunak khusus untuk analisis data. Selain itu, tersedia ruang kerja yang nyaman, ruang diskusi, dan perpustakaan mini yang mendukung kegiatan penelitian dan pembelajaran.
                </p>
            </div>
            <div id="team" class="section mb-4">
                <h2>Tim Kami</h2>
                <p>
                    Tim kami terdiri dari peneliti berpengalaman, asisten laboratorium yang berdedikasi, serta mahasiswa antusias yang bekerja sama untuk mendorong inovasi. Dengan latar belakang yang beragam, tim kami memiliki keahlian di berbagai bidang, mulai dari bioteknologi hingga teknologi informasi.
                </p>
            </div>
            <div id="contact" class="section mb-4">
                <h2>Kontak Kami</h2>
                <p>Email: info@labkami.com</p>
                <p>Telepon: +62 123 456 7890</p>
                <p>Alamat: Jl. Ilmiah No. 123, Kota Riset</p>
            </div>
        </div>

        <div class="card-footer text-center">
            <a href="{{ route('data-Lab') }}" class="btn btn-gr">Kembali ke Daftar Laboratorium</a>
        </div>
    </div>

</div>

@endsection
