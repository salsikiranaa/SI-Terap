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
        const bsip = {!! $bsip !!}

        const provinsi = bsip.map(item => {
            return {
                id: item.id,
                name: item.provinsi.name,
                coords: [item.provinsi.longitude, item.provinsi.latitude],
            }
        })
        
        // Inisialisasi peta dengan koordinat pusat Indonesia
        var map = L.map('map').setView([-2.5489, 118.0149], 5); // Koordinat Indonesia

        // Tambahkan tile layer dari OpenStreetMap
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            // attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var provinces = provinsi

        // Loop untuk menambahkan marker dan popup untuk setiap provinsi
        provinces.forEach(function(province) {
            var marker = L.marker(province.coords).addTo(map);
            marker.bindPopup("<b>" + province.name + "</b><br><a href='/kinerja-kegiatan/identifikasi/provinsi/"+ province.id +"' class='detail_provinsi' target='_blank'>Klik untuk melihat detail</a>");
        });
    </script>
@endsection
