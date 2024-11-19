<!DOCTYPE html>
<html lang="en">
<head>
    </head>
<body>
    @extends('layouts.header_navbar_footer_lp2tp')

    @section('content')
    <style>
    
    #carousel .carousel-item img {
        height: 100px;
        width: 100%;
        object-fit: cover;
        height: 500px;
        margin: 0 auto;
        margin-bottom: 50px;  
         
    }

    .navbar {
  margin-bottom: 0; /* Hilangkan jarak bawah navbar */
}

#carousel {
  margin-top: 0 !important;
}


    .carousel-slide {
      padding-top: 0px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

  
    #map {
            height: 500px;
            width: 100%;
            padding: 50px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
    

/* Add more CSS rules to style the rest of the elements */
    </style>

<div id="carousel-siterap" class="carousel slide" data-bs-ride="true">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/assets/img/kebun1.png"  class="d-block w-100" alt="kebun">
      <div class="carousel-caption d-none d-md-block">
        <h4>Gapoknak Wijaya Kusumah,Danda Jaya, Barito Kuala</h4>
        <p>3°6'38",114°40'30",51,0m, 178°</p>
        <p>23/07/2018 13:40:18</p>
      </div>
    </div>

    <div class="carousel-item">
      <img src="assets/img/sapi.png" class="d-block w-100" alt="Gapoknak Wijaya Kusumah">
    </div>

    <div class="carousel-item">
      <img src="assets/img/kpgayo.png" class="d-block w-100" alt="kebun percobaan Gayo">
    </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>   

  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

  <div class="content stylish-content">
    <h4 class="page-title">Sebaran Instalasi Penelitian dan Pengkajian Teknologi Pertanian di Indonesia</h4>
    <div id="map"></div> <!-- Map Container -->
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
</body>
</html>