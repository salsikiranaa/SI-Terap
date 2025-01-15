@extends('layouts.layoutIp2tp')

@section('content')
<style>
    body {
        background-color: #ffffff;
    }

        /* Styling untuk konten profil */
        .profil-section {
        margin: 40px auto;
        text-align: center;
    }

    .profil-section h1 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .profil-section .description {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 30px;
        text-align: justify;
    }

    .profil-section .stats {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .profil-section .stats div {
        text-align: center;
    }

    .profil-section .stats h3 {
        color: #28a745;
        margin: 0;
        font-size: 24px;
        font-weight: bold;
    }

    .profil-section .stats p {
        margin: 5px 0 0;
        font-size: 14px;
        color: #555;
    }

    .profil-section .cta {
        margin-top: 20px;
        margin-bottom: 30px;
        font-weight: bold;
        color: #28a745;
        text-decoration: none;
        display: inline-block;
    }

    .profil-section img {
        width: 100%;
        border-radius: 8px;
        object-fit: cover;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        align-items: flex-start;
    }

    .stylish-content {
        margin: 0 auto;
        max-width: 1200px;
        padding: 20px 10px; /* Mengurangi padding */
        border-radius: 0px;
    }


</style>
<body>

<div class="container profil-section">
    <h1>Profil Instalasi Penelitian dan Pengkajian Teknologi Pertanian KP.Gayo</h1>
        <div class="row">
            <div style="max-width: 400px; overflow: hidden;">
                <img src="/assets/img/kp-gayo.jpg" alt="Gambar BBPSIP">
                <p class="mt-2 text-center text-warning">
                    <b><span style="color: black;">📍 KP Aceh </span></b><br> 
                    <span style="color: green;">Kepala IP2SIP Aceh - Andi Supriyanto, S.Pt</span>
                </p>
            </div>
            <div style="max-width: 600px;">
                <p class="description">
                Sejarah singkat asal usul Kebun Percobaan ini berawal dari adanya proyek IDAP (1976-1986) kerjasana Indonesia dengan kerajoon Belanda. Pada tahun 1980 masyarakat petani kop di Aceh Tengah tergantung kehidupannya pada komoditi kopi sementora produksi hanya 500 kg/ hektar dalam setahun. Selain itu mutu kopi juga masih rendah akibat tidak adanya prosesing yang baik sehingga pada tahun 1984 dibangun pabrik prosesing kopi arabika. sengan kapas tas 15 ton kopi glondong nerah perharinya. Hal ini bertujuan untuk meningkatkan kualitas mutu kopi sehinggo meningkatkan pendapatan masyarakat tani sekitarnya. 
                </p>
            </div>
        </div>
</div>

            <!-- Table with Static Data -->
            <div class="table-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">BPSIP</th>
                            <th rowspan="2">IP2SIP (Menurut Kepmentan No.93/2019)</th>
                            <th rowspan="2">Luas IP2SIP (Ha)</th>
                            <th rowspan="2">Jumlah SDM</th>
                            <th colspan="6">Jenis Kegiatan Kerja Sama dan Jumlah Luasan Pemanfaatan IP2SIP TA 2024</th>
                            <th rowspan="2">Total Luas Pemanfaatan (Ha)</th>
                        </tr>
                        <tr>
                            <th rowspan="2">Pengkajian, Produksi, SDG, dll</th>
                            <th rowspan="2">(Ha)</th>
                            <th rowspan="2">Keg. Perbenihan</th>
                            <th rowspan="2">(Ha)</th>
                            <th rowspan="2">Keg. Kerja Sama</th>
                            <th rowspan="2">(Ha)</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Aceh</td>
                            <td>KP. Gayo</td>
                            <td>19.8</td>
                            <td>Lahan kering, dataran tinggi</td>
                            <td>7</td>
                            <td>1. Pengkajian <br>
                                2. Plasma Nutfah  <br>
                                3. Kebun Produksi  <br>
                                4. Visitor Plot</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>19.8</td>
                        </tr>
                    </tbody>
                </table>
</body>
@endsection