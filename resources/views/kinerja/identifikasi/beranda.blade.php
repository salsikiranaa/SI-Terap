@extends('layouts.layoutKinerja')

@section('content')
    <style>
        #map {
            width: 100%;
            height: 600px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            margin-top: 30px;
            margin-bottom: 30px;
        }

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
            background-color: #006633;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 1.1em;
        }

        .stylish-button:hover {
            background-color: #009144;
        }

        .map-container {
            padding: 20px; 
            background-color: #f4f4f4;
            border-radius: 15px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
        }

        .leaflet-tooltip {
            background-color: rgba(0, 69, 44, 0.8);
            color: white;
            font-size: 12px;
            padding: 5px;
            border-radius: 5px;
        }

        .stylish-content {
            margin: 0 auto;
            max-width: 1200px;
            padding: 40px 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="content stylish-content">
        <h1 class="page-title">Peta Sebaran Identifikasi dan Inventarisasi SIP</h1>

        <div class="map-container">
            <div id="map"></div>
        </div>

        <a href="{{ route('form_sip') }}" class="stylish-button">Isi Data Lembaga Penerap SIP</a>
    </div>

    <!-- Include Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        var map = L.map('map').setView([5.5, 95.2], 9); // Fokus ke Aceh, zoom level 9

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var bounds = L.latLngBounds([[-10.0, 95.0], [6.0, 141.0]]);
        map.setMaxBounds(bounds);
        map.on('drag', function () {
            map.panInsideBounds(bounds, { animate: true });
        });

        var acehPolygon = L.polygon([
            [5.2649, 95.2930],
            [5.3781, 95.5557],
            [5.4930, 95.6655],
            [5.6926, 95.4510],
            [5.5665, 95.2100],
            [5.3622, 95.2192],
            [5.2649, 95.2930]
        ], {
            color: 'white',           
            fillColor: '#3388ff',    
            fillOpacity: 0.5         
        }).addTo(map);

        acehPolygon.on('click', function () {
            window.location.href = "{{ route('provinsi', ['nama_provinsi' => 'aceh']) }}"; 
        });

        acehPolygon.bindTooltip("Provinsi Aceh", {
            permanent: false,         
            direction: 'top',         
            className: 'aceh-tooltip' 
        });
    </script>
@endsection
