@extends('layouts.layoutIp2tp')

@section('content')
<style>
    /* Carousel Styling */
    #carousel-siterap .carousel-item img {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }

    /* Styling untuk konten profil */
    .profil-section {
        margin: 40px auto;
        text-align: center;
    }

    .profil-section h1 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .profil-section .description {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 30px;
        text-align: justify;
    }

    .profil-section .stats {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .profil-section .stats div {
        text-align: center;
    }

    .profil-section .stats h3 {
        color: #28a745;
        margin: 0;
        font-size: 24px;
        font-weight: bold;
    }

    .profil-section .stats p {
        margin: 5px 0 0;
        font-size: 14px;
        color: #555;
    }

    .profil-section .cta {
        margin-top: 20px;
        margin-bottom: 30px;
        font-weight: bold;
        color: #28a745;
        text-decoration: none;
        display: inline-block;
    }

    .profil-section img {
        width: 100%;
        border-radius: 8px;
        object-fit: cover;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        align-items: flex-start;
    }

    .map-container {
        margin-top: 40px;
        text-align: center;
    }

    .map-container h1 {
        font-size: 20px;
        font-weight: bold;
        margin-top: 50px;
        margin-bottom: 20px;
    }

    #map {
        width: 90%;
        height: 500px;
        margin: 0 auto;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .profil-section h1 {
            font-size: 18px;
        }

        .profil-section .description {
            font-size: 14px;
        }

        .profil-section .stats h3 {
            font-size: 20px;
        }

        .profil-section .stats p {
            font-size: 12px;
        }

        .profil-section .cta {
            float: none;
            text-align: center;
        }

        #carousel-siterap .carousel-item img {
            height: 300px;
        }

        #map {
            height: 400px;
        }
    }
</style>

<div id="carousel-siterap" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/assets/img/kebun1.png" class="d-block w-100" alt="slide 1">
            <div class="carousel-caption d-none d-md-block">
                <h4>Gapoknak Wijaya Kusumah, Danda Jaya, Barito Kuala</h4>
                <p>3°6'38",114°40'30",51.0m, 178°</p>
                <p>23/07/2018 13:40:18</p>
            </div>
        </div>
        <!-- Slide lainnya -->
    </div>

    <!-- Navigasi carousel -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-siterap" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel-siterap" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container profil-section">
    <h1>SISTEM INFORMASI INSTALASI PENELITIAN DAN PENGKAJIAN TEKNOLOGI PERTANIAN (IP2TP) LINGKUP BBPSIP</h1>
    <div class="row">
        <div style="max-width: 400px; overflow: hidden;">
            <img src="/assets/img/gedung-bsip.jpg" alt="Gambar BBPSIP">
        </div>
        <div style="max-width: 600px;">
            <p class="description">
                BBPSIP (Balai Besar Penerapan Standar Instrumen Pertanian), yang sebelumnya bernama BBP2TP (Balai Besar Pengkajian dan Pengembangan Teknologi Pertanian),
                adalah UPT di bawah Badan Standardisasi Instrumen Pertanian, Kementerian Pertanian yang bertugas mengelola Kebun Percobaan di berbagai wilayah sebagai
                sarana pengkajian dan pengembangan teknologi pertanian.
            </p>
            <div class="stats">
                <div>
                    <h3>60</h3>
                    <p>IP2TP</p>
                    <p>(tersebar di 28 BBPSIP)</p>
                </div>
                <div>
                    <h3>2.569,47</h3>
                    <p>hektar</p>
                    <p>Luas KP Lingkup BBPSIP</p>
                </div>
                <div>
                    <h3>307</h3>
                    <p>Luas kebun terbesar</p>
                    <p>(KP Makariki - Maluku)</p>
                </div>
            </div>
        </div>
        <a href="{{ route('profil_bsip') }}" class="cta">Info Selengkapnya →</a>

    </div>
</div>

<div class="map-container">
    <h1>Sebaran Instalasi Penelitian dan Pengkajian Teknologi Pertanian di Indonesia</h1>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-2.5489, 118.0149], 5);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var provinces = [
            { name: "Aceh", coords: [4.695135, 96.749397] },
            { name: "Sumatera Utara", coords: [3.585242, 98.675598] },
            { name: "Jawa Barat", coords: [-6.917464, 107.619125] }
        ];

        provinces.forEach(function(province) {
            var marker = L.marker(province.coords).addTo(map);
            marker.bindPopup("<b>" + province.name + "</b><br><a href='#'>Klik untuk melihat detail</a>");
        });
    </script>
</div>

<div class="content-slider container mt-5">
  <h1 class="text-center mb-4">Profil Instalasi Penelitian dan Pengkajian Teknologi Pertanian</h1>
  <div id="contentCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
          <!-- Slide 1 -->
          <div class="carousel-item active">
              <div class="row align-items-center">
                  <div class="col-md-8">
                      <p class="text-justify">
                          Sejarah singkat asal usul Kebun Percobaan ini berawal dari adanya proyek IDAP (1976-1986) kerja sama Indonesia dengan Kerajaan Belanda. Pada tahun 1980 masyarakat petani kopi di Aceh Tengah tergantung kehidupannya pada komoditi kopi sementara produksi hanya 500 kg/hektar dalam setahun. Selain itu, mutu kopi juga masih rendah akibat tidak adanya proses pengolahan yang baik. Pada tahun 1984 dibangun pabrik pengolahan kopi arabika dengan kapasitas 15 ton kopi glondong per hari untuk meningkatkan kualitas mutu kopi sehingga dapat meningkatkan pendapatan masyarakat sekitar.
                      </p>
                      <p class="text-justify">
                          Kemudian Balai Pengkajian Teknologi Pertanian (BPTP) NAD kembali mengubah namanya menjadi Kebun Percobaan (KP) Gayo hingga sekarang. Luas Kebun Percobaan ini sekitar 18 hektar, terdiri dari bangunan perkantoran, gedung Lab, perumahan, dan kebun kopi sertifikasi. Fasilitas tersebut digunakan untuk penelitian, pembibitan, serta pengembangan Flasma Nutfah Varitas kopi arabika.
                      </p>
                  </div>
                  <div class="col-md-4 text-center">
                      <img src="/assets/img/kp-gayo.jpg" class="img-fluid rounded" alt="KP Gayo">
                      <p class="mt-2 text-center text-warning">
                          <b>📍 KP Gayo (Aceh)</b><br> Kepala IP2TP Gayo - Bardi Ali, S.Pt
                      </p>
                  </div>
              </div>
          </div>
          <!-- Slide 2 -->
          <div class="carousel-item">
              <div class="row align-items-center">
                  <div class="col-md-8">
                      <p class="text-justify">
                          Kebun Percobaan KP Malang merupakan salah satu instalasi penelitian terbesar di Jawa Timur. Dengan luas lebih dari 50 hektar, kebun ini menjadi pusat penelitian untuk pengembangan teknologi pertanian berbasis hortikultura, seperti buah-buahan dan sayuran. Selain itu, KP Malang juga memiliki fasilitas lengkap seperti laboratorium tanah, gedung percontohan irigasi, serta pusat pelatihan petani.
                      </p>
                      <p class="text-justify">
                          Tujuan utama dari kebun ini adalah untuk mendukung inovasi teknologi pertanian di Jawa Timur. Penelitian di kebun ini banyak difokuskan pada pengembangan varietas hortikultura unggul serta budidaya organik, yang bertujuan untuk meningkatkan hasil panen dengan cara yang ramah lingkungan.
                      </p>
                  </div>
                  <div class="col-md-4 text-center">
                      <img src="/assets/img/bpkgayo.jpg" class="img-fluid rounded" alt="KP Malang">
                      <p class="mt-2 text-center text-warning">
                          <b>📍 KP Malang (Jawa Timur)</b><br> Kepala IP2TP Malang - Andi Supriyanto, S.Pt
                      </p>
                  </div>
              </div>
          </div>
      </div>
      <!-- Navigasi Carousel -->
      <button class="carousel-control-prev" type="button" data-bs-target="#contentCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#contentCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
      </button>
  </div>
</div>

@endsection
