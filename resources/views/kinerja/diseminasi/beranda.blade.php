@extends('layouts.layoutKinerja')

@section('content')
<style>
    .dashboard {
        padding: 20px;
    }

    .maincontainer {
        max-width: 1200px; /* Sesuaikan dengan lebar logo */
        margin: 0 auto;   /* Untuk memastikan elemen berada di tengah */
        padding: 0 20px;  /* Tambahkan padding jika diperlukan */
    }

    h1 {
        text-align: center;
        color: #006400;
        font-size: 26px;
        font-weight: bold;
        margin: 0 0 30px;
    }

    h2 {
        text-align: center;
        color: #006400;
        font-size: 18px;
        margin: 0 0 30px;
    }

    h3 {
        text-align: center;
        color: #006400;
        font-size: 20px;
        font-weight: bold;
        margin: 0 0 30px;
        margin-bottom: 40px;
    }

    .filter-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin: 20px 0;
        padding: 20px;
    }

    .filter-group label {
        display: none; /* Hidden visually but available for screen readers */
        margin: 0px;
    }

    .filter-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        background-color: #fff;
        color: #333;
    }

    .btn-filter {
        padding: 10px 20px;
        background-color: #009144;
        color: #fff;
        font-size: 14px;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 0px;
    }

    .btn-filter:hover {
        background-color: #006400;
    }

    .infographics {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }

    .infographic {
        text-align: center;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .infographic h2 {
        color: #006400;
        margin-bottom: 10px;
        font-size: 18px;
    }

    .icon {
        font-size: 36px;
        color: #009144;
        margin-bottom: 10px;
    }

    .button-container {
        display: flex;
        justify-content: center; 
        align-items: center;   
        margin: 20px 0;         
    }   

    .btn-form {
        display: inline-block;
        margin: 30px auto;
        padding: 10px 20px;
        background-color: #009144;
        color: #fff;
        font-size: 16px;
        text-align: center;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-form:hover {
        background-color: #006400;
    }

    .map-container {
        margin-top: 20px;
        height: 400px;
    }

    #map {
        width: 100%;
        height: 100%;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        margin-bottom: 20px;
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
</style>


<section class="dashboard">
    <div class="maincontainer">
        <h1>Dashboard Diseminasi SIP dan Peserta</h1>
        <!-- Infographics -->
        <h3>Jumlah Sasaran Diseminasi</h3>
        <div class="infographics">
            <div class="infographic">
                <h2>Jumlah Peserta</h2>
                <div class="icon"><i class="fas fa-users"></i></div>
                <p>120</p>
            </div>
            <div class="infographic">
                <h2>Sasaran Peserta</h2>
                <div class="icon"><i class="fas fa-users"></i></div>
                <p>100</p>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="filter-container">
            <div class="filter-group">
                <select id="bpsip" name="bpsip" class="filter-input">
                    <option value="">BPSIP</option>
                    <option value="aceh">Aceh</option>
                    <option value="papua">Papua</option>
                </select>
            </div>

            <div class="filter-group">
                <input id="tanggal" type="month" name="tanggal" class="filter-input">
            </div>

            <div class="filter-group">
                <select id="sip" name="sip" class="filter-input">
                    <option value="">SIP</option>
                    <option value="tp">TP</option>
                    <option value="horti">Horti</option>
                </select>
            </div>

            <div class="filter-group">
                <select id="jenis-standar" name="jenis-standar" class="filter-input">
                    <option value="">Jenis Standar</option>
                    <option value="sni">SNI</option>
                    <option value="iso">ISO</option>
                </select>
            </div>

            <div class="filter-group">
                <button type="submit" class="btn-filter">Filter</button>
            </div>
        </div>

        <!-- Kegiatan Table -->
        <table id="kegiatan-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>BPSIP</th>
                    <th>Tahun</th>
                    <th>SIP</th>
                    <th>Metode</th>
                    <th>Sasaran</th>
                    <th>Jumlah Sasaran</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <h3>SIP yang didiseminasikan</h3>
            <div class="infographics">
                <div class="infographic">
                    <h2>Tanaman Pangan (TP)</h2>
                    <div class="icon"><i class="fas fa-seedling"></i></div>
                    <p>Jumlah SNI: 20</p> 
                    <p>Kelompok SNI: 5</p> 
                </div>
                <div class="infographic">
                    <h2>Hortikultura (Horti)</h2>
                    <div class="icon"><i class="fas fa-carrot"></i></div>
                    <p>Jumlah SNI: 15</p>
                    <p>Kelompok SNI: 3</p>
                </div>
                <div class="infographic">
                    <h2>Buah-Buahan (Bun)</h2>
                    <div class="icon"><i class="fas fa-apple-alt"></i></div>
                    <p>Jumlah SNI: 10</p>
                    <p>Kelompok SNI: 2</p>
                </div>
                <div class="infographic">
                    <h2>Peternakan (Nak)</h2>
                    <div class="icon"><i class="fas fa-piggy-bank"></i></div>
                    <p>Jumlah SNI: 12</p>
                    <p>Kelompok SNI: 4</p>
                </div>
                <div class="infographic">
                    <h2>Agroinput</h2>
                    <div class="icon"><i class="fas fa-cogs"></i></div>
                    <p>Jumlah SNI: 8</p>
                    <p>Kelompok SNI: 2</p>
                </div>
                <div class="infographic">
                    <h2>Pasar Pertanian (Paspa)</h2>
                    <div class="icon"><i class="fas fa-store"></i></div>
                    <p>Jumlah SNI: 18</p>
                    <p>Kelompok SNI: 6</p>
                </div>
            </div>

            <!-- Filter Form 
            <div class="filter-container">
                <div class="filter-group">
                    <select id="bpsip" name="bpsip" class="filter-input">
                        <option value="">Sub Sektor</option>
                        <option value="aceh">TP</option>
                        <option value="papua">Horti</option>
                        <option value="papua">Bun</option>
                        <option value="papua">Nak</option>
                        <option value="papua">Agroinput</option>
                        <option value="papua">Paspa</option>
                    </select>
                </div>
                <div class="filter-group">
                    <button type="submit" class="btn-filter">Filter</button>
                </div>
            </div>
            -->

        <!-- Kegiatan Table 
        <table id="kegiatan-table-diseminasi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Sub Sektor</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        -->


            <div class="button-container">
                <a href="{{ route('diseminasi.form_sektor') }}" class="btn-form">Isi Form</a>
            </div>

        <!-- Map -->
        <div class="map-container">
            <h3>Peta Sebaran</h3>
            <div id="map"></div>
        </div>
    </div>
</section>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([-6.200000, 106.816666], 5);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    L.marker([-6.200000, 106.816666]).addTo(map).bindPopup("Jakarta").openPopup();

        // Data kegiatan (dummy data)
        const kegiatanData = [
            { no: 1, bpsip: 'Aceh', tahun: 2023, sip: 'TP', metode: 'Bimbingan Teknis', sasaran: 'Petani', jumlah: '10' },
            { no: 2, bpsip: 'Aceh', tahun: 2023, sip: 'TP', metode: 'Bimbingan Teknis', sasaran: 'Petani', jumlah: '10' },
            { no: 3, bpsip: 'Aceh', tahun: 2023, sip: 'TP', metode: 'Bimbingan Teknis', sasaran: 'Petani', jumlah: '10' },
        ];
        function displayData(data) {
            const tableBody = document.querySelector('#kegiatan-table tbody');
            tableBody.innerHTML = ''; 

            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.no}</td>
                    <td>${item.bpsip}</td>
                    <td>${item.tahun}</td>
                    <td>${item.sip}</td>
                    <td>${item.metode}</td>
                    <td>${item.sasaran}</td>
                    <td>${item.jumlah}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        displayData(kegiatanData);

         // Data sub sektor (dummy data)
         const subSektorData = [
        { no: 1, subSektor: 'Tanaman Pangan (TP)' },
        { no: 2, subSektor: 'Hortikultura (Horti)' },
        { no: 3, subSektor: 'Buah-Buahan (Bun)' },
        { no: 4, subSektor: 'Peternakan (Nak)' },
        { no: 5, subSektor: 'Agroinput' },
        { no: 6, subSektor: 'Pasar Pertanian (Paspa)' },
    ];

    function displaySubSektor(data) {
        const tableBody = document.querySelector('#kegiatan-table-diseminasi tbody');
        tableBody.innerHTML = ''; 

        data.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.no}</td>
                <td>${item.subSektor}</td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Tampilkan data sub sektor
    displaySubSektor(subSektorData);

</script>
@endsection
