@extends('layouts.layoutIp2tp')

@section('content')
<style>
    /* Base styles */
    .asset-dashboard {
        background-color: #f8f9fa;
        padding: 30px 0;
    }

    /* Typography */
    .page-title {
        color: #009144;
        font-weight: 600;
        margin-bottom: 5px;
        font-size: 26px;
    }
    
    .subtitle {
        font-size: 1rem;
        color: #555;
        margin-bottom: 25px;
    }

    /* Card styling */
    .content-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        padding: 25px;
        margin-bottom: 30px;
    }
    
    /* Filter section */
    .filter-section {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 25px;
        align-items: center;
    }

    .filter-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-container select, 
    .filter-container input {
        padding: 10px 15px;
        font-size: 0.95rem;
        border-radius: 5px;
        border: 1px solid #ddd;
        min-width: 200px;
        height: 42px;
        background-color: #fff;
        transition: border-color 0.3s;
    }
    
    .filter-container select:focus,
    .filter-container input:focus {
        border-color: #009144;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 145, 68, 0.1);
    }

    /* Buttons */
    .btn-search {
        padding: 10px 16px;
        background-color: #00452C;
        color: white;
        border: none;
        border-radius: 5px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        height: 42px;
        font-weight: 500;
    }

    .btn-search:hover {
        background-color: #006633;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .action-buttons {
        display: flex;
        gap: 12px;
    }
    
    .btn-action {
        padding: 10px 16px;
        color: white;
        border: none;
        border-radius: 6px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        text-decoration: none;
        background-color: #009144;
        min-width: 130px;
    }
    
    .btn-action:hover {
        background-color: #00b36b;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        color: white;
        text-decoration: none;
    }
    
    .btn-action i {
        margin-right: 8px;
    }

    /* Table styles */
    .table-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 0;
    }
    
    .table th {
        background-color: #f2f7f4;
        color: #00452C;
        padding: 14px 16px;
        font-weight: 600;
        border-bottom: 2px solid #009144;
        text-align: center;
        font-size: 14px;
        white-space: nowrap;
    }
    
    .table td {
        padding: 14px 16px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
        color: #333;
        font-size: 14px;
    }
    
    .table tbody tr:hover {
        background-color: #f9fdfb;
    }
    
    .table tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Custom scrollbar for table */
    .table-responsive {
        overflow-x: auto;
        scrollbar-width: thin;
        scrollbar-color: #009144 #f0f0f0;
    }
    
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }
    
    .table-responsive::-webkit-scrollbar-track {
        background: #f0f0f0;
        border-radius: 10px;
    }
    
    .table-responsive::-webkit-scrollbar-thumb {
        background-color: #009144;
        border-radius: 10px;
    }
    
    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 25px;
        align-items: center;
    }
    
    .pagination {
        display: flex;
        align-items: center;
        gap: 8px;
        justify-content: center;
        padding: 15px 0;
        margin-bottom: 0;
    }

    .page-item {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border: 1.5px solid #00452C; 
        color: #00452C;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 14px;
    }

    .page-item.active {
        background-color: #00452C;
        color: white;
        border: none;
    }
    
    .page-item.disabled {
        pointer-events: none;
        opacity: 0.6;
        color: white !important;
        background-color: #aaa;
        border: none !important;
    }

    .page-item:hover:not(.active):not(.disabled) {
        background-color: #e6f7ee;
        transform: translateY(-2px);
    }

    .dots {
        font-size: 20px;
        color: #00a652;
        margin: 0 5px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 992px) {
        .filter-section {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .action-buttons {
            margin-top: 15px;
            width: 100%;
        }
        
        .btn-action {
            flex: 1;
        }
    }
    
    @media (max-width: 768px) {
        .filter-container {
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }
        
        .filter-container select,
        .filter-container input,
        .btn-search {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .action-buttons {
            flex-direction: column;
            width: 100%;
        }
        
        .btn-action {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .table-container {
            border-radius: 8px;
        }
        
        .pagination {
            flex-wrap: wrap;
        }
    }
</style>

<section class="asset-dashboard">
    <div class="container">
        <h2 class="page-title">Aset - Alat & Mesin</h2>
        <p class="subtitle">Pendataan Sarana dan Prasarana Berupa Alat & Mesin</p>
        
        <div class="content-card">
            <div class="filter-section">
                <form action="{{ route('aset.alat_mesin') }}" method="GET" class="filter-container">
                    <select id="bpsip" name="bsip_id" class="form-select">
                        <option value="">Semua BSIP</option>
                        @foreach ($all_bsip as $bs)
                            <option value="{{ $bs->id }}" {{ request()->bsip_id == $bs->id ? 'selected' : '' }}>{{ $bs->name }}</option>
                        @endforeach
                    </select>
                    
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search me-2"></i> Cari
                    </button>
                </form>

                <div class="action-buttons">
                    <button type="button" onclick="exportTableToExcel()" class="btn-action">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">BPTP</th>
                            <th width="15%">Nama KP</th>
                            <th width="10%">Jenis Aset</th>
                            <th width="10%">Luas Lahan (m<sup>2</sup>)</th>
                            <th width="10%">Tahun Perolehan</th>
                            <th width="12%">Bukti Kepemilikan</th>
                            <th width="13%">Nomor Sertifikat</th>
                            <th width="10%">Penanggung Jawab</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aset_alat as $aa)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $aa->ip2sip->bsip->name }}</td>
                                <td>{{ $aa->ip2sip->name }}</td>
                                <td>{{ $aa->jenis_aset }}</td>
                                <td class="text-end">{{ number_format($aa->luas_lahan, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $aa->tahun_perolehan }}</td>
                                <td>{{ $aa->bukti_kepemilikan }}</td>
                                <td>{{ $aa->nomor_sertifikat ?: '-' }}</td>
                                <td>{{ $aa->pj_sertifikat ?: '-' }}</td>
                            </tr>
                        @endforeach
                        
                        @if(count($aset_alat) == 0)
                            <tr>
                                <td colspan="9" class="text-center py-4">Tidak ada data yang tersedia</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            <div class="pagination-container">
                <div class="pagination">
                    <a href="{{ route('aset.alat_mesin', [...request()->query(), 'page' => $aset_alat->currentPage()-1]) }}" class="page-item {{ $aset_alat->currentPage() == 1 ? 'disabled' : '' }}">&lt;</a>
                    
                    @if ($aset_alat->lastPage() > 1)
                        @php
                            $startPage = max(1, $aset_alat->currentPage() - 2);
                            $endPage = min($aset_alat->lastPage(), $aset_alat->currentPage() + 2);
                            
                            if ($startPage > 1) {
                                echo '<a href="'.route('aset.alat_mesin', [...request()->query(), 'page' => 1]).'" class="page-item">1</a>';
                                if ($startPage > 2) {
                                    echo '<span class="dots">...</span>';
                                }
                            }
                            
                            for ($i = $startPage; $i <= $endPage; $i++) {
                                if ($i == $aset_alat->currentPage()) {
                                    echo '<div class="page-item active">'.$i.'</div>';
                                } else {
                                    echo '<a href="'.route('aset.alat_mesin', [...request()->query(), 'page' => $i]).'" class="page-item">'.$i.'</a>';
                                }
                            }
                            
                            if ($endPage < $aset_alat->lastPage()) {
                                if ($endPage < $aset_alat->lastPage() - 1) {
                                    echo '<span class="dots">...</span>';
                                }
                                echo '<a href="'.route('aset.alat_mesin', [...request()->query(), 'page' => $aset_alat->lastPage()]).'" class="page-item">'.$aset_alat->lastPage().'</a>';
                            }
                        @endphp
                    @endif
                    
                    <a href="{{ route('aset.alat_mesin', [...request()->query(), 'page' => $aset_alat->currentPage()+1]) }}" class="page-item {{ $aset_alat->currentPage() == $aset_alat->lastPage() ? 'disabled' : '' }}">&gt;</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- SheetJS (xlsx) CDN untuk export Excel -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script>
    function exportTableToExcel() {
        // Mendapatkan referensi tabel
        var table = document.querySelector('.table');
        if (!table) {
            alert('Tabel tidak ditemukan!');
            return;
        }
        
        // Membuat workbook baru
        var wb = XLSX.utils.book_new();
        
        // Mengambil data dari tabel
        var data = [];
        
        // Menambahkan header
        var headers = [];
        var headerRow = table.querySelectorAll('thead th');
        headerRow.forEach(function(th) {
            headers.push(th.textContent.trim());
        });
        data.push(headers);
        
        // Menambahkan data baris
        var rows = table.querySelectorAll('tbody tr');
        rows.forEach(function(row) {
            // Skip row if it's the "no data available" row
            if (row.cells.length === 1 && row.cells[0].colSpan > 1) {
                return;
            }
            
            var rowData = [];
            var cells = row.querySelectorAll('td');
            
            cells.forEach(function(cell) {
                rowData.push(cell.textContent.trim());
            });
            
            data.push(rowData);
        });
        
        // Membuat worksheet
        var ws = XLSX.utils.aoa_to_sheet(data);
        
        // Mengatur lebar kolom (perkiraan)
        var wscols = [
            {wch: 5},  // No
            {wch: 20}, // BPTP
            {wch: 20}, // Nama KP
            {wch: 15}, // Jenis Aset
            {wch: 15}, // Luas Lahan
            {wch: 15}, // Tahun Perolehan
            {wch: 20}, // Bukti Kepemilikan
            {wch: 20}, // Nomor Sertifikat
            {wch: 20}  // Penanggung Jawab
        ];
        ws['!cols'] = wscols;
        
        // Menambahkan worksheet ke workbook
        XLSX.utils.book_append_sheet(wb, ws, "Aset Alat & Mesin");
        
        // Membuat nama file dengan tanggal saat ini
        var now = new Date();
        var fileName = 'Aset_Alat_Mesin_' + 
                       now.getFullYear() + 
                       ('0' + (now.getMonth() + 1)).slice(-2) + 
                       ('0' + now.getDate()).slice(-2) + 
                       '.xlsx';
        
        // Mengekspor file Excel
        XLSX.writeFile(wb, fileName);
    }
</script>
@endsection