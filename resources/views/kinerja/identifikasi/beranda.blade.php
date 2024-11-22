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
            background-color: #006633;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 1.1em;
        }

        .stylish-button:hover {
            background-color: #009144;
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
            height: 500px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="content stylish-content">
        <h1 class="page-title">Peta Sebaran Identifikasi dan Inventarisasi SIP</h1>
        <div id="map"></div> 
        <a href="{{ route('form_sip') }}" class="stylish-button">Isi Data Lembaga Penerap SIP</a>
    </div>

    <!-- Add Leaflet JS after the map -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        // Inisialisasi peta dengan koordinat pusat Indonesia
        var map = L.map('map').setView([-2.5489, 118.0149], 5); // Koordinat Indonesia

        // Tambahkan tile layer dari OpenStreetMap
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Data koordinat untuk beberapa provinsi di Indonesia
        var provinces = [
            { name: "Aceh", coords: [4.695135, 96.749397] },
            { name: "Sumatera Utara", coords: [3.585242, 98.675598] },
            { name: "Sumatera Barat", coords: [-0.789275, 100.650558] },
            { name: "Riau", coords: [0.507068, 101.447777] },
            { name: "Jawa Barat", coords: [-6.917464, 107.619125] },
            { name: "Jawa Tengah", coords: [-7.566298, 110.831787] },
            { name: "Jawa Timur", coords: [-7.250445, 112.768845] },
            { name: "Kalimantan Timur", coords: [-0.502106, 117.153709] },
            { name: "Sulawesi Selatan", coords: [-5.147665, 119.432732] },
            { name: "Papua", coords: [-4.269928, 138.080353] }
        ];

        // Loop untuk menambahkan marker dan popup untuk setiap provinsi
        provinces.forEach(function(province) {
            var marker = L.marker(province.coords).addTo(map);
            marker.bindPopup("<b>" + province.name + "</b><br><a href='{{ route('identifikasi.provinsi') }}?provinsi=" + encodeURIComponent(province.name) + "' target='_blank'>Klik untuk melihat detail</a>");
        });
    </script>
@endsection
