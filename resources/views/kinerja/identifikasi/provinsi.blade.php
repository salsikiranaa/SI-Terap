@extends('layouts.layoutKinerja')

@section('content')
    <style>
        .map-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px 0;
            width: 100%;
        }
        #map-provinsi {
            width: 100%;
            max-width: 1200px;
            height: 600px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .data-table {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        .data-table th, .data-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .data-table th {
            background-color: #00452C;
            color: #fff;
        }
    </style>

    <div class="content stylish-content">
        <h1 class="page-title">Peta Sebaran - Provinsi Aceh</h1>

        <div class="map-container">
            <div id="map-provinsi"></div> 
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>BSIP</th>
                    <th>Tahun</th>
                    <th>SIP</th>
                    <th>Sasaran Penerap</th>
                    <th>Jenis Usulan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>BSIP-ACEH-001</td>
                    <td>2023</td>
                    <td>SIP-ACEH-1001</td>
                    <td>Pertanian</td>
                    <td>Usulan Baru</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Include Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        var mapProvinsi = L.map('map-provinsi').setView([5.2649, 95.2930], 9);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(mapProvinsi);

        var acehPolygon = L.polygon([
            [5.2649, 95.2930],
            [5.3781, 95.5557],
            [5.4930, 95.6655],
            [5.6926, 95.4510],
            [5.5665, 95.2100],
            [5.3622, 95.2192],
            [5.2649, 95.2930]
        ], {
            color: 'blue',
            fillColor: '#3388ff',
            fillOpacity: 0.5
        }).addTo(mapProvinsi);

        acehPolygon.bindTooltip("Provinsi Aceh", {
            permanent: true,
            direction: 'center',
            className: 'aceh-tooltip'
        });
    </script>
@endsection
