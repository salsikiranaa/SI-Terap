@extends('layouts.layoutPengelolaanUpbs')

@section('content')

<style>
    .disabled {
        pointer-events: none;
        opacity: 0.6;
        color: white !important;
        background-color: gray;
        border: none !important;
    }

    .content.stylish-content {
        padding: 20px;
    }

    .page-title {
        text-align: center;
        font-size: 2em;
        color: #00452C;
        margin: 20px 0;
        margin-bottom: 50px;
        padding-top: 70px !important;
    }

    .stylish-button {
        display: block;
        width: fit-content;
        margin: 20px auto;
        padding: 12px 25px;
        color: white;
        background-color: #00452C;
        text-decoration: none;
        border-radius: 5px;
        text-align: center;
        font-size: 1.1em;
    }

    .stylish-button:hover {
        background-color: #006633;
    }

    .stylish-content {
        margin: 0 auto;
        max-width: 1200px;
        padding: 40px 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    #map {
        height: 400px;
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        overflow: hidden;
        border-radius: 7px;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #00452C;
        color: white;
    }

    .filter{
        background-color: #e7e7e7;
        padding: 20px 20px 0 20px;
        border-radius: 5px;
    }
    
    .filter-container {
        margin-bottom: 20px;
    }

    .filter-container select, .filter-container input {
        padding: 8px;
        font-size: 1em;
        margin-right: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .form-row button {
        padding: 8px 15px;
        background-color: #00452C;
        color: white;
        border: none;
        border-radius: 5px;
        height: 50px;
        margin-top: 32px;
    }

    .form-row button:hover {
        background-color: #006633;
    }

    .form-container {
        max-width: 90%;
        margin: auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        font-family: 'Poppins', sans-serif;
        color: #333;
        margin-bottom: 50px; 
    }

    .form-title {
        font-size: 2em;
        font-weight: bold;
        color: #006633;
        text-align: center;
        margin-top: 50px;
        margin-bottom: 100px;
        text-transform: uppercase;
    }

    .form-group {
        margin-bottom: 25px;
        flex: 1 1 45%; /* Mengatur setiap kolom memiliki lebar 45% */
        width: auto;
    }

    label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
        color: #333;
    }

    select, input[type="text"], input[type="number"], input[type="date"] {
        width: 100%;
        padding: 12px;
        border: 2px solid #ccc;
        border-radius: 6px;
        font-size: 1em;
        transition: border-color 0.3s ease;
    }

    select:focus, input[type="text"]:focus, input[type="number"]:focus, input[type="date"]:focus {
        border-color: #00452C;
        outline: none;
    }

    select::placeholder, input[type="date"], input[type="number"], input[type="text"], input[type="option"]{
        color: #888;
    }

    .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .radio-group {
        display: flex;
        gap: 20px;
    }

    .submit-button {
        background-color: #006633;
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 6px;
        font-size: 1.1em;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        text-align: center;
    }

    .submit-button:hover {
        background-color: #009144;
        box-shadow: 0 4px 8px rgba(0, 100, 70, 0.3);
    }

    .form-group input[type="checkbox"] {
        margin-right: 5px;
    }

    .form-group input[type="radio"] {
        margin-right: 5px;
    }

    .form-row{
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .table{
        border: #00452C;
        border-radius: 5px;
    }

    /* PAGINATION */

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

    #resetFilter{
        /* padding: 8px 15px; */
        background-color: #e7e7e7;
        color: #00452C;
        border-color: #00452C;
        border-style: solid;
        border-radius: 5px;
        border-width: 1.5px;
        height: 50px;
        margin-top: 32px;
    }

    #resetFilter:hover{
        background-color: #006633;
        color: white;
        border-color: #006633;
        border-style: solid;
        border-radius: 5px;
        height: 50px;
        margin-top: 32px;
    }

    .link-benih {
        text-decoration: none;
        color: #00452C;
        font-weight: bold;
        transition: color 0.3s;
    }

    .link-benih:hover {
        color: #007B5E;
        text-decoration: underline;
    }
</style>

<h1 class="page-title">Data Distribusi Benih - Provinsi {{ $bsip ? $bsip->name : '' }}</h1>

<div class="content stylish-content">
    <!-- Filter Section -->
    <div class="filter">
        <form action="{{ route('perbenihan.provinsi', request()->bsip_id) }}" class="form-row">
            <div class="form-group col-md-5">
                <label for="bsip">BSIP</label>
                {{-- <input type="text" name="bsip" id="bsip" placeholder="Masukkan Nama BSIP" style="width: 360px" required> --}}
                <select name="bsip_id" id="bsip">
                    <option value="">Pilih BSIP</option>
                    {{-- @foreach ($bsip as $kb)
                        <option value="{{ $kb->id }}" {{ request()->bsip_id == $kb->id ? 'selected' : '' }}>{{ $kb->name }}</option>
                    @endforeach --}}
                </select>
            </div>
            
            <div class="form-group col-md-5">
                <label for="kotaKabupatenBenih">Kota/Kabupaten</label>
                {{-- <input type="text" name="kotaKabupatenBenih" id="kotaKabupatenBenih" placeholder="Masukkan Nama Kota/Kabupaten" style="width: 360px" required> --}}
                <select name="kabupaten_id" id="kotaKabupatenBenih">
                    <option value="">Pilih Kota/Kabupaten</option>
                    @foreach ($kabupaten as $kb)
                        <option value="{{ $kb->id }}" {{ request()->kabupaten_id == $kb->id ? 'selected' : '' }}>{{ $kb->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-5">
                <label for="kecamatanBenih">Kecamatan</label>
                {{-- <input type="text" name="kecamatanBenih" id="kecamatanBenih" placeholder="Masukkan Nama Kecamatan" style="width: 360px" required> --}}
                <select name="kecamatan_id" id="kecamatanBenih">
                    <option value="">Pilih Kecamatan</option>
                    {{-- @foreach ($kecamatan as $kb)
                        <option value="{{ $kb->id }}" {{ request()->kecamatan_id == $kb->id ? 'selected' : '' }}>{{ $kb->name }}</option>
                    @endforeach --}}
                </select>
            </div>
            
            <div class="form-group col-md-5">
                <label for="komoditasBenih">Komoditas</label>
                <select name="komoditas_id" id="komoditasBenih" style="height: 52px">
                    <option value="">Pilih Salah Satu</option>
                    @foreach ($komoditas as $km)
                        <option value="{{ $km->id }}" {{ request()->komoditas_id == $km->id ? 'selected' : '' }}>{{ $km->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group col-md-5">
                <label for="kelasBenih">Kelas Benih</label>
                <select name="kelas_benih_id" id="kelasBenih" style="height: 52px">
                    <option value="">Pilih Salah Satu</option>
                    @foreach ($kelas_benih as $kb)
                        <option value="{{ $kb->id }}" {{ request()->kelas_benih_id == $kb->id ? 'selected' : '' }}>{{ $kb->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-5">
                <label for="tanggalPerbenihan">Tanggal</label>
                <input type="date" name="tanggalBenih" class="form-control" id="tanggalperbenihan"></input>
            </div>
            
            {{-- <button type="button" onclick="filterData()">Filter</button> --}}
            <button type="submit">Filter</button>

            <a href="{{ route('perbenihan.provinsi', request()->bsip_id) }}" id="resetFilter" class="btn btn-secondary d-flex align-items-center" type="button">Reset</a>
        </form>
    </div>

    <!-- Kegiatan Table -->
    <table id="perbenihan-table">
        <thead>
            <tr>
                <th>No</th>
                <th>BSIP</th>
                <th>Kota/Kabupaten</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Komoditas</th>
                <th>Kelas Benih</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perbenihan as $pb)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pb->bsip->name }}</td>
                    <td>{{ $pb->kabupaten->name }}</td>
                    <td>{{ $pb->kecamatan->name }}</td>
                    <td>{{ $pb->namapenerap->name }}</td>
                    <td>{{ $pb->nopenerap->name }}</td>
                    <td>{{ $pb->komoditas->name }}</td>
                    <td>{{ $pb->kelas_benih->name }}</td>
                    <td>{{ $pb->Jumlah }}</td>
                    <td>{{ $pb->tanggal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {{ dd($perbenihan) }} --}}
    <div class="pagination">
        <a href="{{ route('perbenihan.provinsi', ['bsip_id' => request()->bsip_id, ...request()->query(), 'page' => $perbenihan->currentPage()-1]) }}" class="page-item text-decoration-none {{ $perbenihan->currentPage() == 1 ? 'disabled' : '' }}">&lt;</a> <!-- Left arrow -->
        @if ($perbenihan->lastPage() > 5 && $perbenihan->currentPage() - 5 > 1)
            <span class="dots">...</span> <!-- Dots -->
        @endif
        @for ($i = 1; $i < $perbenihan->currentPage()+1; $i++)
            @if ($i >= $perbenihan->currentPage() - 5 || $i <= $perbenihan->currentPage() + 5)
                @if ($i == $perbenihan->currentPage())
                    <div class="page-item text-decoration-none active">{{ $i }}</div> <!-- Active page -->
                @else
                    <a href="{{ route('perbenihan.provinsi', ['bsip_id' => request()->bsip_id, ...request()->query(), 'page' => $i]) }}" class="page-item text-decoration-none">{{ $i }}</a>
                @endif
            @endif
        @endfor
        @if ($perbenihan->lastPage() > 5 && $perbenihan->lastPage() > $perbenihan->currentPage() + 5)
            <span class="dots">...</span> <!-- Dots -->
        @endif
        <a href="{{ route('perbenihan.provinsi', ['bsip_id' => request()->bsip_id, ...request()->query(), 'page' => $perbenihan->currentPage()+1]) }}" class="page-item text-decoration-none {{ $perbenihan->currentPage() == $perbenihan->lastPage() ? 'disabled' : '' }}">&gt;</a> <!-- Right arrow -->
    </div>
</div>

<script>
    // const perbenihanData = [
    //     { no: 1, id: 1, kotaKabupatenBenih: 'Kabupaten Aceh Besar', komoditasBenih: 'Padi', kelasBenih: 'BS', bulanPerbenihan: 'Februari', tahunPerbenihan: 2023 },
    //     { no: 2, id: 2, kotaKabupatenBenih: 'Kabupaten Bireuen', komoditasBenih: 'Jagung', kelasBenih: 'FS', bulanPerbenihan: 'Maret', tahunPerbenihan: 2022 },
    //     { no: 3, id: 3, kotaKabupatenBenih: 'Kota Banda Aceh', komoditasBenih: 'Kacang Kedelai', kelasBenih: 'SS', bulanPerbenihan: 'April', tahunPerbenihan: 2024 },
    //     { no: 4, id: 4, kotaKabupatenBenih: 'Kabupaten Aceh Tengah', komoditasBenih: 'Bawang Putih', kelasBenih: 'ES', bulanPerbenihan: 'Mei', tahunPerbenihan: 2023 },
    //     { no: 5, id: 5, kotaKabupatenBenih: 'Kabupaten Aceh Timur', komoditasBenih: 'Cabai', kelasBenih: 'BS', bulanPerbenihan: 'Juni', tahunPerbenihan: 2022 },
    //     { no: 6, id: 6, kotaKabupatenBenih: 'Kabupaten Aceh Barat', komoditasBenih: 'Padi', kelasBenih: 'FS', bulanPerbenihan: 'Juli', tahunPerbenihan: 2024 },
    //     { no: 7, id: 7, kotaKabupatenBenih: 'Kabupaten Aceh Selatan', komoditasBenih: 'Jagung', kelasBenih: 'SS', bulanPerbenihan: 'Agustus', tahunPerbenihan: 2023 },
    //     { no: 8, id: 8, kotaKabupatenBenih: 'Kabupaten Aceh Singkil', komoditasBenih: 'Kacang Kedelai', kelasBenih: 'ES', bulanPerbenihan: 'September', tahunPerbenihan: 2022 },
    //     { no: 9, id: 9, kotaKabupatenBenih: 'Kabupaten Aceh Jaya', komoditasBenih: 'Bawang Putih', kelasBenih: 'BS', bulanPerbenihan: 'Oktober', tahunPerbenihan: 2023 },
    //     { no: 10, id: 10, kotaKabupatenBenih: 'Kabupaten Aceh Tamiang', komoditasBenih: 'Cabai', kelasBenih: 'FS', bulanPerbenihan: 'November', tahunPerbenihan: 2024 }
    // ];

    function filterData() {
        const kotaKabupatenBenih = document.getElementById('kotaKabupatenBenih').value.toLowerCase();
        const tahunPerbenihan = document.getElementById('tahunPerbenihan').value;
        const bulanPerbenihan = document.getElementById('bulanPerbenihan').value;
        const komoditasBenih = document.getElementById('komoditasBenih').value.toLowerCase();
        const kelasBenih = document.getElementById('kelasBenih').value.toLowerCase();

        console.log("Filter values - Kota Kabupaten:", kotaKabupatenBenih, "Komoditas Benih:", komoditasBenih, "Kelas Benih:", kelasBenih, "Bulan Perbenihan:", bulanPerbenihan, "Tahun Perbenihan:", tahunPerbenihan);

        const filteredData = perbenihanData.filter(item => {
            return (
                (kotaKabupatenBenih === '' || item.kotaKabupatenBenih.toLowerCase().includes(kotaKabupatenBenih)) &&
                (komoditasBenih === '' || item.komoditasBenih.toLowerCase() === komoditasBenih) &&
                (kelasBenih === '' || item.kelasBenih.toLowerCase() === kelasBenih) &&
                (bulanPerbenihan === '' || item.bulanPerbenihan.toLowerCase() === bulanPerbenihan) &&
                (tahunPerbenihan === '' || item.tahunPerbenihan === parseInt(tahunPerbenihan, 10))
            );
        });

        displayData(filteredData);
        }

        function displayData(data) {
            const tableBody = document.querySelector('#perbenihan-table tbody');
            tableBody.innerHTML = ''; 

            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.no}</td>
                    <td>
                        <a href="${toDetail}" class="link-benih">
                            ${item.kotaKabupatenBenih}
                        </a>    
                    </td>
                    <td>${item.komoditasBenih}</td>
                    <td>${item.kelasBenih}</td>
                    <td>${item.bulanPerbenihan}</td>
                    <td>${item.tahunPerbenihan}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        // const toDetail = "{{-- route('pendampingan_detail') --}}";

        document.getElementById('resetFilter').addEventListener('click', () => {
    // Reset all input fields to their default values
            document.getElementById('kotaKabupatenBenih').value = '';
            document.getElementById('komoditasBenih').value = '';
            document.getElementById('kelasBenih').value = ''; // Reset dropdown to default
            document.getElementById('bulanPerbenihan').value = '';
            document.getElementById('tahunPerbenihan').value = '';

            // Display all data since filter is cleared
            displayData(perbenihanData);
        });

        displayData(perbenihanData);
</script>

@endsection