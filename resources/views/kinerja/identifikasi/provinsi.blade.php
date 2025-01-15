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
            margin: 15px auto;
            padding: 8px 15px;
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
            display: flex;
            align-items: center;
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
            margin-right: 10px;
        }

        .filter-container button:hover {
            background-color: #006633;
        }
    </style>

    <div class="content stylish-content">
        <h1 class="page-title">Peta Sebaran Identifikasi dan Inventarisasi SIP Provinsi {{ $bsip_identifikasi->name }}</h1>

        <!-- Filter Section -->
        <form action="{{ route('identifikasi.provinsi.filter') }}" method="POST" class="filter-container">
            @csrf
            <label for="bpsip">BPSIP:</label>
            <select id="bpsip" name="bsip_id">
                @foreach ($bsip as $b)
                    <option value="{{ $b->id }}" {{ request()->bsip_id == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                @endforeach
            </select>

            <label for="year">Tahun:</label>
            <select name="tahun" id="year">
                <option value="">Tahun</option>
                @for ($i = intval(date('Y')); $i >= 2000; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            <label for="sip-type">Usulan SIP/Revisi SIP:</label>
            <select id="sip-type" name="jenis_usulan">
                <option value="">Pilih Usulan SIP/Revisi SIP</option>
                <option value="baru">Usulan SIP</option>
                <option value="revisi">Revisi SIP</option>
            </select>

            <button type="submit">Filter</button>

            <!-- Export PDF Button -->
            <a href="{{ route('identifikasi.provinsi.export-pdf', $bsip_identifikasi->id) }}" class="stylish-button">Export PDF</a>
            </form>

        <!-- Kegiatan Table -->
        <h2>Data Kegiatan yang Dilakukan</h2>
        <table id="kegiatan-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>BPSIP</th>
                    <th>Tahun</th>
                    <th>Usulan SIP/Revisi SIP</th>
                    <th>Nama Kegiatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($identifikasi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->bsip->name }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->jenis_usulan == 'baru' ? 'Usulan SIP' : 'Revisi SIP' }}</td>
                        <td>{{ $item->metode->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // const kegiatanData = [
        //     { no: 1, bpsip: 'BPSIP 1', tahun: 2023, type: 'Usulan SIP', nama: 'Kegiatan A' },
        //     { no: 2, bpsip: 'BPSIP 2', tahun: 2024, type: 'Revisi SIP', nama: 'Kegiatan B' },
        //     { no: 3, bpsip: 'BPSIP 1', tahun: 2023, type: 'Usulan SIP', nama: 'Kegiatan C' },
        // ];

        function filterData() {
            const bpsip = document.getElementById('bpsip').value;
            const year = document.getElementById('year').value;
            const sipType = document.getElementById('sip-type').value;

            const filteredData = kegiatanData.filter(item => {
                return (
                    (bpsip === '' || item.bpsip === bpsip) &&
                    (year === '' || item.tahun === parseInt(year)) &&
                    (sipType === '' || item.type === sipType)
                );
            });

            displayData(filteredData);
        }

        function displayData(data) {
            const tableBody = document.querySelector('#kegiatan-table tbody');
            tableBody.innerHTML = ''; 

            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.no}</td>
                    <td>${item.bpsip}</td>
                    <td>${item.tahun}</td>
                    <td>${item.type}</td>
                    <td>${item.nama}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        displayData(kegiatanData);
    </script>
@endsection
