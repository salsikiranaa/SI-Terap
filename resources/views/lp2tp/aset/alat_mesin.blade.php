@extends('layouts.layoutIp2tp')

@section('content')
    <style>
        .disabled {
            pointer-events: none;
            opacity: 0.6;
            color: white !important;
            background-color: gray;
            border: none !important;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            padding: 25px;
        }

        .page-item {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 25px;
            height: 25px;
            border: 1.5px solid #00452C; 
            color: #00452C;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .page-item.active {
            background-color: #00452C;
            color: white;
            border: none;
        }

        .page-item.active:hover {
            background-color: #00452C;
            color: white;
            border: none;
        }


        .dots {
            font-size: 24px;
            color: #00a652;
        }

        .page-item:hover {
            background-color: #d6f7e1;
        }
        .asset-dashboard {
            background-color: #f5f5f5;
        }

        h2 {
            margin-top: 80px;
            text-align: left;
            color: #009144;
            padding: 10px;
        }
    
        .filter-container {
            display: flex;
            margin-bottom: 20px;
        }

        .filter-container select, .filter-container input {
            padding: 8px;
            font-size: 1em;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .filter-container button {
            padding: 8px 10px;
            background-color: #00452C;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .filter-container button:hover {
            background-color: #006633;
        }
          /* New styles for export button */
        .export-button {
        float: right;
        padding: 8px 15px;
        background-color: #009144; /* Green color */
        color: white;
        border: none;
        border-radius: 5px;
        margin-left: 625px; /* Push the button to the right side */
        }

        .export-button:hover {
        background-color: #00b36b; /* Darker green on hover */
        }

        .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        }

  </style>

    </style>

    <section class="asset-dashboard">
        <div class="container">
            <h2 class="heading" style="margin-top: 40px;">Aset - Alat & Mesin</h1>
            <hr>

        <div class="d-flex align-items-center justify-content-between">
            <form class="w-75 d-flex align-items-center gap-2 mb-3">
                   <!-- Filter Section -->
                <div class="filter-container">
                    <select id="bpsip" name="bsip_id" placeholder="BSIP">
                        <option value="">Semua BSIP</option>
                        @foreach ($all_bsip as $bs)
                            <option value="{{ $bs->id }}" {{ request()->bsip_id == $bs->id ? 'selected' : '' }}>{{ $bs->name }}</option>
                        @endforeach
                    </select>
                    
                    <button type="submit" class="btn btn-success">Cari</button>
                </div>
              </form>
              
            <div class="d-flex align-items center justify-content-end gap-2 w-50">
                <a  class="btn btn-success">
                    <i class="fa-solid fa-file-excel"></i>&ensp;
                    Import Excel
                </a>
            </div>
        </div>

        <p>Pendataan Sarana dan Prasarana Berupa Alat & Mesin</p>

            <!-- Table with Static Data -->
            <div class="table-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>BPTP</th>
                            <th>Nama KP</th>
                            <th>Jenis Aset</th>
                            <th>Luas Lahan (m<sup>2</sup>)</th>
                            <th>Tahun Perolehan</th>
                            <th>Bukti Kepemilikan</th>
                            <th>Nomor Sertifikat</th>
                            <th>Penanggung Jawab Sertifikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aset_alat as $aa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $aa->ip2sip->bsip->name }}</td>
                                <td>{{ $aa->ip2sip->name }}</td>
                                <td>{{ $aa->jenis_aset }}</td>
                                <td>{{ $aa->luas_lahan }}</td>
                                <td>{{ $aa->tahun_perolehan }}</td>
                                <td>{{ $aa->bukti_kepemilikan }}</td>
                                <td>{{ $aa->nomor_sertifikat }}</td>
                                <td>{{ $aa->pj_sertifikat }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    <a href="{{ route('aset.alat_mesin', [...request()->query(), 'page' => $aset_alat->currentPage()-1]) }}" class="page-item text-decoration-none {{ $aset_alat->currentPage() == 1 ? 'disabled' : '' }}">&lt;</a> <!-- Left arrow -->
                    @if ($aset_alat->lastPage() > 5 && $aset_alat->currentPage() - 5 > 1)
                        <span class="dots">...</span> <!-- Dots -->
                    @endif
                    @for ($i = 1; $i < $aset_alat->currentPage()+1; $i++)
                        @if ($i >= $aset_alat->currentPage() - 5 || $i <= $aset_alat->currentPage() + 5)
                            @if ($i == $aset_alat->currentPage())
                                <div class="page-item text-decoration-none active">{{ $i }}</div> <!-- Active page -->
                            @else
                                <a href="{{ route('aset.alat_mesin', [...request()->query(), 'page' => $i]) }}" class="page-item text-decoration-none">{{ $i }}</a>
                            @endif
                        @endif
                    @endfor
                    @if ($aset_alat->lastPage() > 5 && $aset_alat->lastPage() > $aset_alat->currentPage() + 5)
                        <span class="dots">...</span> <!-- Dots -->
                    @endif
                    <a href="{{ route('aset.alat_mesin', [...request()->query(), 'page' => $aset_alat->currentPage()+1]) }}" class="page-item text-decoration-none {{ $aset_alat->currentPage() == $aset_alat->lastPage() ? 'disabled' : '' }}">&gt;</a> <!-- Right arrow -->
                </div>
            </div>


        </div>
    </section>
    
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
