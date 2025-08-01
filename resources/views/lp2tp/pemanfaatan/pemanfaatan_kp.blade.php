@extends('layouts.layoutIp2tp')

@section('content')
    <style>
    /* ===== BASE STYLES ===== */
    /* Container utama dashboard */
    .asset-dashboard {
        background-color: #f8f9fa;
        padding: 30px 0;
        min-height: 100vh;
    }

    /* ===== TYPOGRAPHY ===== */
    /* Judul halaman dengan warna hijau khas */
    .page-title {
        color: #009144;
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 1.75rem;
    }

    /* Subtitle deskripsi halaman */
    .subtitle {
        font-size: 1rem;
        color: #555;
        margin-bottom: 25px;
    }

    /* ===== FILTER SECTION ===== */
    /* Container untuk filter dan tombol aksi */
    .filter-section {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    /* Container untuk form filter */
    .filter-container {
        display: flex;
        align-items: center;
        flex-wrap: nowrap; /* Ubah dari wrap menjadi nowrap agar tetap sejajar */
    }

    /* Style untuk select dan input filter - DIPERBAIKI */
    .filter-container select, 
    .filter-container input {
        padding: 8px 12px;
        font-size: 0.95rem;
        border-radius: 5px; /* Ubah dari 5px 0 0 5px menjadi 5px penuh */
        border: 1px solid #ddd;
        min-width: 180px; /* Kurangi dari 200px menjadi 180px */
        width: auto; /* Tambahkan width auto */
        height: 38px;
        transition: border-color 0.3s ease;
        margin-right: 10px; /* Tambahkan jarak 10px ke kanan */
    }

    .filter-container select:focus {
        outline: none;
        border-color: #009144;
    }

    /* ===== BUTTONS ===== */
    /* Tombol search - DIPERBAIKI */
    .btn-search {
        padding: 9px 12px;
        background-color: #28B96C;
        color: white;
        border: none;
        border-radius: 5px; /* Ubah dari 0 5px 5px 0 menjadi 5px penuh */
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        height: 38px;
        margin-left: 0; /* Hilangkan margin negatif */
        cursor: pointer;
    }

    .btn-search:hover {
        background-color: #22a862;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Container untuk tombol-tombol aksi */
    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-left: auto; /* Push action buttons to the right */
    }

    /* Style umum untuk tombol aksi */
    .btn-action {
        padding: 8px 16px;
        color: white;
        border: none;
        border-radius: 4px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        font-weight: 500;
        text-decoration: none;
        font-size: 0.9rem;
        cursor: pointer;
    }

    .btn-action:hover {
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
        transform: translateY(-1px);
        color: white;
        text-decoration: none;
    }

    /* Tombol tambah data dengan warna hijau baru */
    .btn-add {
        background-color: #28B96C;
    }

    .btn-add:hover {
        background-color: #22a862;
    }

    /* Tombol export dengan warna hijau baru */
    .btn-export {
        background-color: #28B96C;
    }

    .btn-export:hover {
        background-color: #22a862;
    }

    /* Icon dalam tombol */
    .btn-icon {
        margin-right: 8px;
    }

    /* ===== ALERT MESSAGES ===== */
    .alert {
        padding: 12px 20px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 6px;
        font-size: 14px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .alert-warning {
        color: #856404;
        background-color: #fff3cd;
        border-color: #ffeaa7;
    }

    .alert-info {
        color: #0c5460;
        background-color: #d1ecf1;
        border-color: #bee5eb;
    }

    /* ===== SHOW ENTRIES SECTION ===== */
    .table-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .entries-selector {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #495057;
        font-size: 0.9rem;
    }

    .entries-selector select {
        padding: 6px 30px 6px 10px;
        border: 2px solid #e9ecef;
        border-radius: 6px;
        font-size: 0.9rem;
        color: #495057;
        background: white;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 8px center;
        background-repeat: no-repeat;
        background-size: 16px;
        appearance: none;
        cursor: pointer;
        transition: all 0.3s ease;
        min-width: 70px;
    }

    .entries-selector select:focus {
        outline: none;
        border-color: #009144;
        box-shadow: 0 0 0 3px rgba(0, 145, 68, 0.1);
    }

    .entries-selector select:hover {
        border-color: #009144;
    }

    .table-info {
        color: #6c757d;
        font-size: 0.85rem;
        font-weight: 500;
    }

    /* ===== TABLE INFO BOTTOM STYLES - UPDATED ===== */
    .table-info-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-left: 10px;
        padding-right: 10px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .table-info-bottom .table-info {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
        text-align: left;
    }

    /* ===== TABLE STYLES ===== */
    /* Container tabel dengan card style */
    .table-container {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 10px;
        margin-bottom: 30px;
        overflow-x: auto;
    }

    /* Tabel utama */
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    /* Header tabel */
    .data-table th {
        background-color: #f2f7f4;
        color: #00452C;
        padding: 14px 16px;
        text-align: left;
        font-weight: 600;
        border-bottom: 2px solid #009144;
        white-space: nowrap;
    }

    /* Khusus untuk kolom aksi - text di tengah */
    .data-table th:last-child {
        text-align: center;
    }

    /* Cell tabel */
    .data-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }

    /* Cell aksi - konten di tengah */
    .data-table td:last-child {
        text-align: center;
    }

    /* Cell dokumentasi - konten di tengah */
    .data-table td:nth-child(6) {
        text-align: center;
    }

    /* Hover effect untuk baris tabel */
    .data-table tr:hover {
        background-color: #f9fdfb;
    }

    /* List dalam tabel */
    .data-table ol {
        padding-left: 20px;
        margin-bottom: 0;
    }

    .data-table ol li {
        margin-bottom: 4px;
    }

    /* Link dalam tabel */
    .data-table a {
        color: #00452C;
        text-decoration: none;
        transition: color 0.3s;
        font-weight: 500;
    }

    .data-table a:hover {
        color: #009144;
        text-decoration: underline;
    }

    /* State kosong ketika tidak ada data */
    .empty-state {
        text-align: center;
        padding: 60px 30px;
        color: #6c757d;
        font-style: italic;
        font-size: 1.1rem;
    }

    /* ===== DOCUMENTATION BUTTON ===== */
    .doc-button {
        background-color: #0275d8;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 12px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block; /* Ubah dari inline-flex ke inline-block */
        font-weight: 500;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        text-align: center; /* Tambahkan text alignment */
    }

    .doc-button:hover {
        background-color: #0069d9;
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
    }

    .doc-button i {
        margin-right: 5px;
        font-size: 0.75rem;
    }

    /* ===== ACTION BUTTONS IN TABLE ===== */
    /* Group tombol aksi dalam tabel */
    .action-button-group {
        display: inline-flex;
        gap: 6px;
        justify-content: center;
        align-items: center;
    }

    /* Tombol edit dengan warna kuning - Icon Only */
    .btn-edit {
        background: linear-gradient(135deg, #ffc107, #ffca2c);
        color: #212529;
        border: none;
        border-radius: 6px;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        text-decoration: none;
        font-weight: 500;
        box-shadow: 0 2px 4px rgba(255, 193, 7, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-edit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
    }

    .btn-edit:hover::before {
        left: 100%;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #ffca2c, #ffd60a);
        color: #212529;
        text-decoration: none;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4);
    }

    .btn-edit i {
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Tombol hapus dengan warna merah - Icon Only */
    .btn-delete {
        background: linear-gradient(135deg, #dc3545, #e55563);
        color: white;
        border: none;
        border-radius: 6px;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        font-weight: 500;
        box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-delete::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn-delete:hover::before {
        left: 100%;
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #c82333, #dc3545);
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
    }

    .btn-delete i {
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Tooltip untuk action buttons */
    .btn-edit,
    .btn-delete {
        position: relative;
    }

    .btn-edit:hover::after {
        content: 'Edit';
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: #333;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.7rem;
        white-space: nowrap;
        z-index: 1000;
        margin-bottom: 5px;
    }

    .btn-delete:hover::after {
        content: 'Hapus';
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: #333;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.7rem;
        white-space: nowrap;
        z-index: 1000;
        margin-bottom: 5px;
    }

    /* ===== CUSTOM BEAUTIFUL PAGINATION - UPDATED ===== */
    .custom-pagination {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 8px;
        margin: 0; /* Remove margin karena sudah diatur di parent */
        flex-wrap: wrap;
    }

    .pagination-info {
        background: linear-gradient(135deg, #009144, #28B96C);
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 500;
        box-shadow: 0 4px 15px rgba(0, 145, 68, 0.3);
        margin-bottom: 15px;
        display: inline-block;
    }

    .pagination-controls {
        display: flex;
        align-items: center;
        gap: 5px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        height: 42px;
        padding: 0 12px;
        color: #495057;
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    .page-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .page-btn:hover::before {
        left: 100%;
    }

    .page-btn:hover {
        color: #009144;
        border-color: #009144;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 145, 68, 0.2);
    }

    .page-btn.active {
        color: white;
        background: linear-gradient(135deg, #009144, #28B96C);
        border-color: #009144;
        box-shadow: 0 4px 15px rgba(0, 145, 68, 0.4);
        transform: translateY(-1px);
    }

    .page-btn.disabled {
        color: #adb5bd;
        background: #f8f9fa;
        border-color: #e9ecef;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .page-btn.disabled:hover {
        transform: none;
        box-shadow: none;
        border-color: #e9ecef;
        color: #adb5bd;
    }

    .page-btn i {
        font-size: 0.8rem;
    }

    .page-btn .btn-text {
        margin-left: 5px;
        font-size: 0.85rem;
    }

    .page-btn .btn-text-right {
        margin-right: 5px;
        margin-left: 0;
        font-size: 0.85rem;
    }

    /* Animasi untuk transisi halaman */
    .table-container {
        transition: opacity 0.3s ease;
    }

    .table-loading {
        opacity: 0.6;
        pointer-events: none;
    }

    /* Dots untuk halaman yang tersembunyi */
    .page-dots {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        height: 42px;
        color: #6c757d;
        font-weight: bold;
        font-size: 1rem;
        cursor: default;
    }

    /* ===== RESPONSIVE DESIGN ===== */
    @media (max-width: 768px) {
        /* Filter dan action buttons jadi vertikal di mobile */
        .filter-section {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .filter-container,
        .action-buttons {
            width: 100%;
        }
        
        .filter-container {
            justify-content: flex-start; /* Ubah dari center ke flex-start */
            flex-wrap: wrap; /* Di mobile boleh wrap */
        }
        
        .filter-container select {
            width: auto;
            min-width: 150px; /* Lebih kecil di mobile */
            max-width: 220px;
            margin-right: 10px; /* Tetap ada jarak di mobile */
        }

        .btn-search {
            width: auto; /* Tidak full width, tetap sejajar */
            min-width: 45px;
            flex-shrink: 0; /* Tidak boleh mengecil */
        }
        
        .action-buttons {
            flex-direction: column;
            margin-left: 0;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        /* Table controls responsive */
        .table-controls {
            justify-content: flex-start; /* Align ke kiri di mobile juga */
        }

        .entries-selector {
            justify-content: flex-start; /* Align ke kiri */
        }

        /* Table info bottom responsive */
        .table-info-bottom {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .table-info-bottom .table-info {
            text-align: center;
            width: 100%;
        }
        
        /* Pagination di mobile */
        .custom-pagination {
            justify-content: center;
            width: 100%;
        }

        .pagination-controls {
            gap: 3px;
            justify-content: center;
        }
        
        /* Ukuran font lebih kecil di mobile */
        .data-table {
            font-size: 0.875rem;
        }
        
        .data-table th,
        .data-table td {
            padding: 10px 12px;
        }

        /* Action buttons tetap horizontal di mobile tapi dengan ukuran lebih kecil */
        .action-button-group {
            gap: 4px;
        }

        .btn-edit,
        .btn-delete {
            width: 28px;
            height: 28px;
        }

        .btn-edit i,
        .btn-delete i {
            font-size: 0.7rem;
        }

        .page-btn {
            min-width: 38px;
            height: 38px;
            font-size: 0.85rem;
        }

        .page-btn .btn-text,
        .page-btn .btn-text-right {
            display: none;
        }

        .pagination-info {
            font-size: 0.8rem;
            padding: 8px 16px;
        }
    }

    /* Untuk layar sangat kecil */
    @media (max-width: 480px) {
        .page-title {
            font-size: 1.5rem;
        }

        .data-table {
            font-size: 0.8rem;
        }

        .data-table th,
        .data-table td {
            padding: 8px;
        }

        .page-btn {
            min-width: 35px;
            height: 35px;
            font-size: 0.8rem;
        }

        .btn-edit,
        .btn-delete {
            width: 26px;
            height: 26px;
        }

        .btn-edit i,
        .btn-delete i {
            font-size: 0.65rem;
        }
    }

    /* Smooth scroll untuk navigasi halaman */
    html {
        scroll-behavior: smooth;
    }
    </style>

    <section class="asset-dashboard">
        <div class="container">
            <!-- Header Halaman -->
            <h2 class="page-title">Pemanfaatan Kebun Percobaan</h2>
            <hr>
            
            <!-- Filter dan Action Buttons -->
            <div class="filter-section">
                <!-- Form Filter BPSIP -->
                <form action="{{ route('lp2tp.pemanfaatan_kp') }}" class="filter-container">
                    <select id="bpsip" name="bsip_id" class="form-select">
                        <option selected disabled>Pilih BPSIP</option>
                        @foreach ($all_bsip as $item)
                            <option value="{{ $item->id }}" {{ request()->bsip_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    <button type="submit" class="btn-search" title="Cari data">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                
                <!-- Tombol Aksi -->
                <div class="action-buttons">
                    <a href="{{ route('lp2tp.pemanfaatan_kp.create') }}" class="btn-action btn-add">
                        <i class="fas fa-plus me-1"></i>
                        Tambah Data
                    </a>
                    <button type="button" onclick="exportTableToExcel()" class="btn-action btn-export">
                        <i class="fas fa-file-excel me-1"></i>
                        Export Excel
                    </button>
                </div>
            </div>

            <!-- Table Controls: Show Entries -->
            <div class="table-controls">
                <div class="entries-selector">
                    <span>Tampilkan</span>
                    <select onchange="changePerPage(this.value)">
                        <option value="5" {{ request('per_page', 5) == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page', 5) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page', 5) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page', 5) == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page', 5) == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span>entries</span>
                </div>
                
                <div></div> <!-- Empty div untuk spacing -->
            </div>

            <!-- Tabel Data -->
            <div class="table-container" id="tableContainer">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">BPSIP</th>
                            <th width="12%">Luas IP2SIP (Ha)</th>
                            <th width="12%">Agroekosistem</th>
                            <th width="20%">Pengkajian/Diseminasi</th>
                            <th width="12%">Dokumentasi</th>
                            <th width="19%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pemanfaatan_sip as $index => $item)
                            <tr>
                                <td>{{ ($pemanfaatan_sip->currentPage() - 1) * $pemanfaatan_sip->perPage() + $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('lp2tp_detail', $item->id) }}">
                                        {{ $item->ip2sip->bsip->name }}/KP. {{ $item->ip2sip->name }}
                                    </a>
                                </td>
                                <td>{{ $item->luas_sip }}</td>
                                <td>{{ $item->agro_ekosistem }}</td>
                                <td>
                                    <ol>
                                        @foreach ($item->pemanfaatan_diseminasi as $pd)
                                            <li>{{ $pd->name }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>
                                    <button class="doc-button" onclick="viewDocumentation({{ $item->id }})">
                                        <i class="fas fa-file-image"></i> Lihat
                                    </button>
                                </td>
                                <td>
                                    <div class="action-button-group">
                                        <a href="{{ route('lp2tp.pemanfaatan_kp.edit', $item->id) }}" class="btn-edit" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn-delete" onclick="deleteItem({{ $item->id }})" title="Hapus Data">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block text-muted"></i>
                                    Tidak ada data yang tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Info dan Pagination dalam satu baris -->
            <div class="table-info-bottom">
                <!-- Table Info: Menampilkan x sampai y dari z data -->
                @if($pemanfaatan_sip->total() > 0)
                    <div class="table-info">
                        Menampilkan {{ $pemanfaatan_sip->firstItem() }} sampai {{ $pemanfaatan_sip->lastItem() }} 
                        dari {{ $pemanfaatan_sip->total() }} data
                    </div>
                @else
                    <div class="table-info">
                        Tidak ada data yang ditampilkan
                    </div>
                @endif

                <!-- Custom Beautiful Pagination -->
                @if($pemanfaatan_sip->hasPages())
                    <div class="custom-pagination">
                        <div class="pagination-controls">
                            {{-- Previous Button --}}
                            @if ($pemanfaatan_sip->onFirstPage())
                                <span class="page-btn disabled">
                                    <i class="fas fa-chevron-left"></i>
                                    <span class="btn-text">Sebelumnya</span>
                                </span>
                            @else
                                <a href="{{ $pemanfaatan_sip->appends(request()->except('page'))->previousPageUrl() }}" 
                                   class="page-btn" onclick="showLoading()">
                                    <i class="fas fa-chevron-left"></i>
                                    <span class="btn-text">Sebelumnya</span>
                                </a>
                            @endif

                            {{-- First Page --}}
                            @if($pemanfaatan_sip->currentPage() > 3)
                                <a href="{{ $pemanfaatan_sip->appends(request()->except('page'))->url(1) }}" 
                                   class="page-btn" onclick="showLoading()">1</a>
                                @if($pemanfaatan_sip->currentPage() > 4)
                                    <span class="page-dots">...</span>
                                @endif
                            @endif

                            {{-- Page Numbers --}}
                            @php
                                $start = max($pemanfaatan_sip->currentPage() - 2, 1);
                                $end = min($pemanfaatan_sip->currentPage() + 2, $pemanfaatan_sip->lastPage());
                            @endphp

                            @for ($i = $start; $i <= $end; $i++)
                                @if ($i == $pemanfaatan_sip->currentPage())
                                    <span class="page-btn active">{{ $i }}</span>
                                @else
                                    <a href="{{ $pemanfaatan_sip->appends(request()->except('page'))->url($i) }}" 
                                       class="page-btn" onclick="showLoading()">{{ $i }}</a>
                                @endif
                            @endfor

                            {{-- Last Page --}}
                            @if($pemanfaatan_sip->currentPage() < $pemanfaatan_sip->lastPage() - 2)
                                @if($pemanfaatan_sip->currentPage() < $pemanfaatan_sip->lastPage() - 3)
                                    <span class="page-dots">...</span>
                                @endif
                                <a href="{{ $pemanfaatan_sip->appends(request()->except('page'))->url($pemanfaatan_sip->lastPage()) }}" 
                                   class="page-btn" onclick="showLoading()">{{ $pemanfaatan_sip->lastPage() }}</a>
                            @endif

                            {{-- Next Button --}}
                            @if ($pemanfaatan_sip->hasMorePages())
                                <a href="{{ $pemanfaatan_sip->appends(request()->except('page'))->nextPageUrl() }}" 
                                   class="page-btn" onclick="showLoading()">
                                    <span class="btn-text-right">Selanjutnya</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="page-btn disabled">
                                    <span class="btn-text-right">Selanjutnya</span>
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    
    <script>
        /**
         * Fungsi untuk mengubah jumlah data per halaman
         * @param {string} perPage - Jumlah data per halaman yang dipilih
         */
        function changePerPage(perPage) {
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('per_page', perPage);
            currentUrl.searchParams.delete('page'); // Reset ke halaman pertama
            
            // Show loading
            showLoading();
            
            // Redirect ke URL baru
            window.location.href = currentUrl.toString();
        }

        /**
         * Fungsi untuk menampilkan loading saat pindah halaman
         */
        function showLoading() {
            const tableContainer = document.getElementById('tableContainer');
            if (tableContainer) {
                tableContainer.classList.add('table-loading');
            }
        }

        /**
         * Fungsi untuk menampilkan dokumentasi
         * @param {number} id - ID dari item yang akan dilihat dokumentasinya
         */
        function viewDocumentation(id) {
        window.location.href = '/lp2tp/pemanfaatan-kp/' + id + '/dokumentasi';
        }

        /**
         * Fungsi untuk menghapus item dengan konfirmasi SweetAlert
         * @param {number} id - ID dari item yang akan dihapus
         */
         function deleteItem(id) {
            const url = '/lp2tp/pemanfaatan-kp/' + id;
            confirmDelete(url); // Menggunakan function global dari layout
        }
        
        /**
         * Fungsi untuk export tabel ke Excel
         * Menggunakan library SheetJS (xlsx)
         */
        function exportTableToExcel() {
            // Cek apakah library XLSX sudah di-load
            if (typeof XLSX === 'undefined') {
                alert('Library Excel belum dimuat. Silakan coba lagi.');
                return;
            }

            // Show loading
            showLoading();

            // Mendapatkan referensi tabel
            var table = document.querySelector('.data-table');
            if (!table) {
                alert('Tabel tidak ditemukan!');
                return;
            }
            
            // Membuat workbook baru
            var wb = XLSX.utils.book_new();
            
            // Array untuk menampung data
            var data = [];
            
            // Menambahkan header (exclude kolom aksi)
            var headers = [];
            var headerRow = table.querySelectorAll('thead th');
            headerRow.forEach(function(th, index) {
                if (index !== 6) { // Skip kolom aksi (index 6)
                    headers.push(th.textContent.trim());
                }
            });
            data.push(headers);
            
            // Menambahkan data baris
            var rows = table.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                var rowData = [];
                var cells = row.querySelectorAll('td');
                
                // Cek apakah ini baris kosong (empty state)
                if (cells.length === 1 && cells[0].getAttribute('colspan') === '7') {
                    return; // Skip baris kosong
                }
                
                cells.forEach(function(cell, index) {
                    if (index === 6) { 
                        // Skip kolom aksi
                        return;
                    } else if (index === 4) { 
                        // Kolom Pengkajian/Diseminasi - gabungkan list items
                        var listItems = [];
                        var items = cell.querySelectorAll('li');
                        items.forEach(function(item) {
                            listItems.push(item.textContent.trim());
                        });
                        rowData.push(listItems.join(', '));
                    } else if (index === 5) { 
                        // Kolom Dokumentasi - text saja
                        rowData.push('Lihat dokumentasi');
                    } else {
                        // Kolom lainnya
                        rowData.push(cell.textContent.trim());
                    }
                });
                
                if (rowData.length > 0) {
                    data.push(rowData);
                }
            });
            
            // Membuat worksheet dari array data
            var ws = XLSX.utils.aoa_to_sheet(data);
            
            // Mengatur lebar kolom untuk readability
            var wscols = [
                {wch: 5},   // No
                {wch: 35},  // BPSIP
                {wch: 15},  // Luas IP2SIP
                {wch: 20},  // Agroekosistem
                {wch: 40},  // Pengkajian/Diseminasi
                {wch: 15}   // Dokumentasi
            ];
            ws['!cols'] = wscols;
            
            // Menambahkan worksheet ke workbook
            XLSX.utils.book_append_sheet(wb, ws, "Pemanfaatan KP");
            
            // Membuat nama file dengan timestamp
            var now = new Date();
            var fileName = 'Pemanfaatan_KP_' + 
                           now.getFullYear() + 
                           ('0' + (now.getMonth() + 1)).slice(-2) + 
                           ('0' + now.getDate()).slice(-2) + 
                           '_' +
                           ('0' + now.getHours()).slice(-2) +
                           ('0' + now.getMinutes()).slice(-2) +
                           '.xlsx';
            
            // Download file Excel
            XLSX.writeFile(wb, fileName);
            
            // Remove loading setelah export selesai
            setTimeout(function() {
                const tableContainer = document.getElementById('tableContainer');
                if (tableContainer) {
                    tableContainer.classList.remove('table-loading');
                }
            }, 1000);
        }

        /**
         * Fungsi untuk smooth scroll ke atas saat pindah halaman
         */
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        /**
         * Auto scroll ke atas saat halaman dimuat
         */
        window.addEventListener('load', function() {
            // Remove loading state jika ada
            const tableContainer = document.getElementById('tableContainer');
            if (tableContainer) {
                tableContainer.classList.remove('table-loading');
            }
        });

        /**
         * Inisialisasi saat dokumen ready
         */
        document.addEventListener('DOMContentLoaded', function() {
            // Remove loading state
            const tableContainer = document.getElementById('tableContainer');
            if (tableContainer) {
                tableContainer.classList.remove('table-loading');
            }
            
            // Tambahkan smooth scroll ke pagination links
            const paginationLinks = document.querySelectorAll('.page-btn:not(.disabled):not(.active)');
            paginationLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    setTimeout(scrollToTop, 100);
                });
            });

            // Tambahkan event listener untuk entries selector
            const entriesSelect = document.querySelector('.entries-selector select');
            if (entriesSelect) {
                entriesSelect.addEventListener('change', function() {
                    changePerPage(this.value);
                });
            }
        });
    </script>
    
    <!-- SheetJS (xlsx) CDN untuk export Excel -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
@endsection