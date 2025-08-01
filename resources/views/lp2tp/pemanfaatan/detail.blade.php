@extends('layouts.layoutIp2tp')

@section('content')
<style>
    /* Base styles */
    body {
        background-color: #f8f9fa;
        color: #333;
        font-family: 'Poppins', sans-serif;
    }

    /* Profile Header Section */
    .profile-header {
        background: linear-gradient(135deg, #00452C 0%, #009144 100%);
        padding: 40px 0 60px;
        position: relative;
        margin-bottom: 60px;
    }
    
    .profile-header h1 {
        color: white;
        font-size: 28px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
        padding: 0 15px;
    }
    
    .breadcrumb-container {
        background-color: rgba(255, 255, 255, 0.1);
        padding: 8px 20px;
        border-radius: 30px;
        display: inline-block;
        margin-bottom: 20px;
    }
    
    .breadcrumb-container a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .breadcrumb-container a:hover {
        color: white;
    }
    
    .breadcrumb-container span {
        color: white;
        margin: 0 5px;
    }

    /* Profile Content Section */
    .profile-content {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin-top: -40px;
        padding: 30px;
        margin-bottom: 40px;
        position: relative;
    }
    
    .profile-image {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        height: 100%;
        position: relative;
    }
    
    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    
    .profile-image img:hover {
        transform: scale(1.03);
    }
    
    .profile-image::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 30%;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
        pointer-events: none;
    }
    
    .profile-location {
        position: absolute;
        bottom: 15px;
        left: 15px;
        color: white;
        font-size: 14px;
        z-index: 2;
        display: flex;
        align-items: center;
    }
    
    .profile-location i {
        margin-right: 5px;
        color: #ffd700;
    }

    .profile-description {
        font-size: 16px;
        line-height: 1.8;
        color: #555;
        text-align: justify;
        margin-bottom: 20px;
    }
    
    /* Data Tables Section */
    .data-section {
        padding: 20px 0 50px;
    }
    
    .section-title {
        color: #00452C;
        font-weight: 600;
        font-size: 22px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .table-responsive {
        overflow-x: auto;
        margin-bottom: 30px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }
    
    .data-table th {
        background-color: #f2f7f4;
        color: #00452C;
        padding: 12px;
        text-align: center;
        font-weight: 600;
        border: 1px solid #dee2e6;
        font-size: 14px;
    }
    
    .data-table td {
        padding: 10px 12px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #dee2e6;
        color: #333;
    }
    
    .data-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    
    .activity-list {
        text-align: left;
        padding-left: 20px;
        margin-bottom: 0;
    }
    
    .activity-list li {
        margin-bottom: 4px;
    }
    
    .activity-list li:last-child {
        margin-bottom: 0;
    }
    
    .total-value {
        font-weight: 700;
        color: #00452C;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .profile-header h1 {
            font-size: 24px;
        }
        
        .profile-image {
            margin-bottom: 20px;
            height: 250px;
        }
        
        .profile-description::first-letter {
            font-size: 200%;
        }
        
        .data-table th, 
        .data-table td {
            padding: 10px 8px;
            font-size: 14px;
        }
    }
</style>

<!-- Profile Header Section -->
<div class="profile-header">
    <div class="container">
        <div class="text-center">
            <div class="breadcrumb-container mb-3">
                <a href="#">Beranda</a>
                <span>/</span>
                <a href="#">IP2SIP</a>
                <span>/</span>
                <a href="#">KP Gayo</a>
            </div>
            <h1>Profil Instalasi Penelitian dan Pengkajian Teknologi Pertanian KP. Gayo</h1>
        </div>
    </div>
</div>

<!-- Profile Content Section -->
<div class="container">
    <div class="profile-content">
        <div class="row">
            <div class="col-md-5 mb-4 mb-md-0">
                <div class="profile-image">
                    <img src="/assets/img/kp-gayo.jpg" alt="Kebun Percobaan Gayo">
                    <div class="profile-location">
                        <i class="fas fa-map-marker-alt"></i> Aceh Tengah, Aceh
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <p class="profile-description">
                    Sejarah singkat asal usul Kebun Percobaan ini berawal dari adanya proyek IDAP (1976-1986) kerjasama Indonesia dengan kerajaan Belanda. Pada tahun 1980 masyarakat petani kopi di Aceh Tengah tergantung kehidupannya pada komoditi kopi sementara produksi hanya 500 kg/hektar dalam setahun. Selain itu, mutu kopi juga masih rendah akibat tidak adanya prosesing yang baik sehingga pada tahun 1984 dibangun pabrik prosesing kopi arabika dengan kapasitas 15 ton kopi glondong merah perharinya. Hal ini bertujuan untuk meningkatkan kualitas mutu kopi sehingga meningkatkan pendapatan masyarakat tani sekitarnya.
                </p>
                <div class="row mt-4">
                    <div class="col-6 col-md-4 mb-3">
                        <div class="text-center p-3 rounded" style="background-color: #f2f7f4;">
                            <h3 class="m-0 text-success">19.8</h3>
                            <small class="text-muted">Luas Area (Ha)</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mb-3">
                        <div class="text-center p-3 rounded" style="background-color: #f2f7f4;">
                            <h3 class="m-0 text-success">7</h3>
                            <small class="text-muted">Jumlah SDM</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mb-3">
                        <div class="text-center p-3 rounded" style="background-color: #f2f7f4;">
                            <h3 class="m-0 text-success">4</h3>
                            <small class="text-muted">Kegiatan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Data Section -->
<div class="container data-section">
    <h2 class="section-title">Program Unggulan KP. Gayo</h2>
    
    <!-- Additional Information Cards -->
    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                         style="width: 70px; height: 70px; background-color: #e6f7ee;">
                        <i class="fas fa-coffee text-success" style="font-size: 28px;"></i>
                    </div>
                    <h5 class="card-title text-success">Komoditas Utama</h5>
                    <p class="card-text">Tanaman kopi arabika menjadi komoditas unggulan di KP. Gayo dengan kualitas yang diakui di tingkat nasional dan internasional.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                         style="width: 70px; height: 70px; background-color: #e6f7ee;">
                        <i class="fas fa-flask text-success" style="font-size: 28px;"></i>
                    </div>
                    <h5 class="card-title text-success">Riset & Pengembangan</h5>
                    <p class="card-text">Fokus pada penelitian varietas unggul, teknik budidaya berkelanjutan, dan peningkatan kualitas pasca panen.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                         style="width: 70px; height: 70px; background-color: #e6f7ee;">
                        <i class="fas fa-users text-success" style="font-size: 28px;"></i>
                    </div>
                    <h5 class="card-title text-success">Pemberdayaan Petani</h5>
                    <p class="card-text">Program pelatihan dan pendampingan bagi petani lokal untuk meningkatkan produktivitas dan kesejahteraan.</p>
                </div>
            </div>
        </div>
    </div>
    
    <h2 class="section-title">Data Pemanfaatan KP. Gayo</h2>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">BPSIP</th>
                    <th rowspan="2">IP2SIP</th>
                    <th rowspan="2">Luas IP2SIP (Ha)</th>
                    <th rowspan="2">Jumlah SDM</th>
                    <th colspan="6">Jenis Kegiatan Kerja Sama dan Jumlah Luasan Pemanfaatan IP2SIP TA 2024</th>
                    <th rowspan="2">Total Luas Pemanfaatan (Ha)</th>
                </tr>
                <tr>
                    <th>Pengkajian, Produksi, SDG, dll</th>
                    <th>(Ha)</th>
                    <th>Keg. Perbenihan</th>
                    <th>(Ha)</th>
                    <th>Keg. Kerja Sama</th>
                    <th>(Ha)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Aceh</td>
                    <td>KP. Gayo</td>
                    <td>19.8</td>
                    <td>7</td>
                    <td>
                        <ul class="activity-list">
                            <li>Pengkajian</li>
                            <li>Plasma Nutfah</li>
                            <li>Kebun Produksi</li>
                            <li>Visitor Plot</li>
                        </ul>
                    </td>
                    <td>19.8</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td class="total-value">19.8</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Google Fonts: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endsection