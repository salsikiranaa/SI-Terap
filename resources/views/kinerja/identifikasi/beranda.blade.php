@extends('layouts.header_navbar_footer')

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

        #map {
            height: 400px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="content stylish-content">
        <h1 class="page-title">Peta Sebaran Identifikasi dan Inventarisasi SIP</h1>
        <div id="map"></div> <!-- Map Container -->
        <a href="{{ route('form_sip') }}" class="stylish-button">Isi Data Lembaga Penerap SIP</a>
    </div>

    <!-- Add Leaflet JS after the map -->
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

        // Add marker to Java Barat (Depok as an example)
        var marker = L.marker([-6.4, 106.8]).addTo(map);
        marker.bindPopup("<b>Jawa Barat</b><br><a href='{{ route('identifikasi.provinsi') }}' target='_blank'>Klik untuk melihat Provinsi</a>").openPopup();


        // Add a polygon to mark a larger area (Jawa Barat Region Example)
        var jawaBaratPolygon = L.polygon([
            [-7.5, 108.5], // coordinates of Jawa Barat polygon
            [-7.5, 106.5],
            [-6.5, 106.5],
            [-6.5, 108.5]
        ]).addTo(map);

        jawaBaratPolygon.bindPopup("<b>Jawa Barat</b><br><a href='{{ route('identifikasi.provinsi') }}' target='_blank'>Klik untuk melihat Provinsi</a>").openPopup();

        // Optional: Set up a map click event
        function onMapClick(e) {
            alert("You clicked the map at " + e.latlng);
        }
        map.on('click', onMapClick);
    </script>
@endsection
