@extends('layouts.layoutKinerja')

@section('content')
<style>
    .content.stylish-content {
        padding: 20px;
    }

    .page-title {
        text-align: center;
        font-size: 2em;
        color: #00452C;
        margin: 20px 0;
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

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
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

    .filter-container button {
        padding: 8px 15px;
        background-color: #00452C;
        color: white;
        border: none;
        border-radius: 5px;
    }

    .filter-container button:hover {
        background-color: #006633;
    }
</style>

<div class="content stylish-content">
    <h1 class="page-title">Pendataan dan Diseminasi SIP Provinsi {{ $provinceName }}</h1>

    <!-- Filter Section -->
    <form action="{{ route('diseminasi.provinsi.filter') }}" method="POST" class="filter-container">
        @csrf
        <label for="bsip">BSIP:</label>
        <select id="bsip" name="bsip_id">
            <option value="">Pilih BSIP</option>
            @foreach ($bsip_diseminasi as $bd)
                <option value="{{ $bd->id }}" {{ request()->bsip_id == $bd->id ? 'selected' : '' }}>{{ $bd->name }}</option>
            @endforeach
        </select>

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ request()->tanggal }}">

        <label for="sip">Jenis SIP:</label>
        <select id="sip" name="sip_id">
            <option value="">Pilih SIP</option>
            @foreach ($sip as $sp)
                <option value="{{ $sp->id }}" {{ request()->sip_id == $sp->id ? 'selected' : '' }}>{{ $sp->name }}</option>
            @endforeach
        </select>

        <label for="metode">Metode:</label>
        <select id="metode" name="metode_id">
            <option value="">Pilih Metode</option>
            @foreach ($metode as $mt)
                <option value="{{ $mt->id }}" {{ request()->metode_id == $mt->id ? 'selected' : '' }}>{{ $mt->name }}</option>
            @endforeach
        </select>

        <button type="submit">Filter</button>

    </form>

    <!-- Data Table -->
    <h2>Data Kegiatan</h2>
    <table id="kegiatan-table">
        <thead>
            <tr>
                <th>No</th>
                <th>BSIP</th>
                <th>Tanggal</th>
                <th>Jenis SIP</th>
                <th>Metode</th>
                <th>Sasaran</th>
                <th>Jumlah Sasaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diseminasi as $ds)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ds->bsip->name }}</td>
                    <td>{{ $ds->tanggal }}</td>
                    <td>
                        <ul>
                            @foreach ($ds->sip as $sp)
                                <li>{{ $sp->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $ds->metode->name }}</td>
                    <td>
                        <ul>
                            @foreach ($ds->sasaran as $sr)
                                <li>{{ $sr->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $ds->jumlah_sasaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // const kegiatanData = [
    //     { bsip: 'BSIP 1', tanggal: '2024-01-01', sip: 'Usulan SIP', metode: 'Metode A', sasaran: 'Petani A', jumlah: 10 },
    //     { bsip: 'BSIP 2', tanggal: '2024-02-15', sip: 'Revisi SIP', metode: 'Metode B', sasaran: 'Petani B', jumlah: 20 },
    //     { bsip: 'BSIP 1', tanggal: '2024-03-10', sip: 'Usulan SIP', metode: 'Metode A', sasaran: 'Petani C', jumlah: 15 },
    // ];

    // function filterData() {
    //     const bsip = document.getElementById('bsip').value;
    //     const tanggal = document.getElementById('tanggal').value;
    //     const sip = document.getElementById('sip').value;
    //     const metode = document.getElementById('metode').value;
    //     const sasaran = document.getElementById('sasaran').value.toLowerCase();

    //     const filteredData = kegiatanData.filter(item => {
    //         return (
    //             (bsip === '' || item.bsip === bsip) &&
    //             (tanggal === '' || item.tanggal === tanggal) &&
    //             (sip === '' || item.sip === sip) &&
    //             (metode === '' || item.metode === metode) &&
    //             (sasaran === '' || item.sasaran.toLowerCase().includes(sasaran))
    //         );
    //     });

    //     displayData(filteredData);
    // }

    // function displayData(data) {
    //     const tableBody = document.querySelector('#kegiatan-table tbody');
    //     tableBody.innerHTML = ''; 

    //     data.forEach(item => {
    //         const row = document.createElement('tr');
    //         row.innerHTML = `
    //             <td>${item.bsip}</td>
    //             <td>${item.tanggal}</td>
    //             <td>${item.sip}</td>
    //             <td>${item.metode}</td>
    //             <td>${item.sasaran}</td>
    //             <td>${item.jumlah}</td>
    //         `;
    //         tableBody.appendChild(row);
    //     });
    // }

    // displayData(kegiatanData);
</script>
@endsection
