@extends('layouts.layoutKinerja')

@section('content')
    <style>
        body {
            padding-top: 80px; 
        }

        .dashboard {
            padding: 20px;
            background-color: transparent;
        }

        .maincontainer {
            max-width: 1200px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #009144;
        }

        .infographics {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .infographic {
            flex: 1;
            margin: 0 15px;
            text-align: center;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            min-width: 250px;
        }

        .icon-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .icon {
            font-size: 40px;
            color: #009144;
            margin: 5px;
        }

        .map-container {
            margin-top: 20px;
        }

        .btn-form {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #009144;
            color: #ffffff;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .filter-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .filter-container select, .filter-container input {
            padding: 8px;
            font-size: 16px;
            margin-right: 10px;
            width: 30%;
        }
    </style>

    <section class="dashboard">
        <div class="maincontainer">
            <h1>Dashboard Diseminasi Peserta</h1>
            <div class="infographics">
                <div class="infographic">
                    <h2>Jumlah Peserta</h2>
                    <div class="icon-container">
                        <i class="fas fa-users icon"></i>
                        <p>120</p> 
                    </div>
                </div>
                <div class="infographic">
                    <h2>Sasaran Peserta</h2>
                    <div class="icon-container">
                        <i class="fas fa-users icon"></i>
                        <p>100</p> 
                    </div>
                </div>
            </div>

            <a href="{{ route('diseminasi.form_peserta') }}" class="btn-form">Isi Form</a>

            <div class="filter-container">
                <form method="GET" action="#">
                    <select name="bpsip" id="bpsip">
                        <option value="">BPSIP</option>
                        <option value="aceh">Aceh</option>
                        <option value="papua">Papua</option>
                        <!-- Add other BPSIP options -->
                    </select>
                    <input type="text" name="tanggal" id="tanggal" placeholder="Tanggal Pelaksanaan" />
                    <select name="sip" id="sip">
                        <option value="">SIP</option>
                        <option value="tp">TP</option>
                        <option value="horti">Horti</option>
                        <option value="bun">Bun</option>
                        <option value="nak">Nak</option>
                        <option value="agroinput">Agroinput</option>
                        <option value="paspa">Paspa</option>
                        <!-- Add other SIP options -->
                    </select>
                    <button type="submit">Filter</button>
                </form>
            </div>

            <div class="map-container">
                <h2>Peta Sebaran Peserta per Provinsi</h2>
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        // Initialize the map with a center and zoom level, focus on Indonesia
        var map = L.map('map').setView([-6.200000, 106.816666], 5); // Koordinat Indonesia

        // Add OpenStreetMap tiles
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Example marker for a region (Aceh)
        var marker = L.marker([4.5, 96.9]).addTo(map);
        marker.bindPopup("<b>Aceh</b><br>Informasi lebih lanjut tentang Provinsi Aceh.");

        // Example polygon for Aceh region
        var acehPolygon = L.polygon([ 
            [5.5, 95.5],
            [5.5, 97.5],
            [4.5, 97.5],
            [4.5, 95.5]
        ]).addTo(map);

        acehPolygon.bindPopup("<b>Aceh</b><br>Informasi lebih lanjut tentang Provinsi Aceh.");
    </script>
@endsection
