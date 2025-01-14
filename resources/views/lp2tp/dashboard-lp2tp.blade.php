@extends('layouts.layoutIp2tp')

@section('content')
<style>
    body {
        background-color: #ffffff;
    }

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

    .stylish-content {
        margin: 0 auto;
        max-width: 1200px;
        padding: 20px 10px; /* Mengurangi padding */
        border-radius: 0px;
    }

    .page-title {
        text-align: center;
        font-size: 2em;
        color: #00452C;
        margin: 10px 0; /* Mengurangi jarak vertikal */
    }

    .map-container {
        padding: 15px; 
        background-color: #ffffff;
        border-radius: 15px; 
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
        margin-bottom: 10px;
    }

    #mapindo {
        height: 500px;
        width: 100%;
        /* max-width: 800px; */
        margin: 0 auto;
        margin-bottom: 50px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 10px;
        border-radius: 10px;
    }

    .loading {
        margin-top: 10em;
        text-align: center;
        color: gray;
    }

    .highcharts-title{
        opacity: 0% !important;
    } 

    .highcharts-background{
        fill: #f4f4f4 !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5) !important; 
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

<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

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

        <div class="carousel-item active">
            <img src="/assets/img/kp_cipaku.PNG" class="d-block w-100" alt="slide 2">
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

<div class="content stylish-content">
        <h1 class="page-title">Peta Sebaran Instalasi Penelitian dan Pengkajian Teknologi Pertanian di Indonesia </h1>    
        <div class="map">      
            <div id="mapindo"></div>
        </div>
        <script>
        (async () => {

        const topology = await fetch(
            'https://code.highcharts.com/mapdata/countries/id/id-all.topo.json'
        ).then(response => response.json());

        // Prepare demo data. The data is joined to map using value of 'hc-key'
        // property by default. See API docs for 'joinBy' for more info on linking
        // data and map.
        const data = [
            { id: 1,'hc-key': 'id-ac', value: 11, name: 'Aceh' },
            { id: 10,'hc-key': 'id-jt', value: 12, name: 'Jawa Tengah' },
            { id: null,'hc-key': 'id-be', value: 13, name: 'Bengkulu' },
            { id: 13,'hc-key': 'id-bt', value: 14, name: 'Banten' },
            { id: 16,'hc-key': 'id-kb', value: 15, name: 'Kalimantan Barat' },
            { id: 8,'hc-key': 'id-bb', value: 16, name: 'Bangka Belitung' },
            { id: null,'hc-key': 'id-ba', value: 17, name: 'Bali' },
            { id: 12,'hc-key': 'id-ji', value: 18, name: 'Jawa Timur' },
            { id: 18,'hc-key': 'id-ks', value: 19, name: 'Kalimantan Selatan' },
            { id: 15,'hc-key': 'id-nt', value: 20, name: 'Nusa Tenggara Timur' },
            { id: 22,'hc-key': 'id-se', value: 21, name: 'Sulawesi Selatan' },
            { id: null,'hc-key': 'id-kr', value: 22, name: 'Kepulauan Riau' },
            { id: 28,'hc-key': 'id-ib', value: 23, name: 'Papua Barat' },
            { id: 2,'hc-key': 'id-su', value: 24, name: 'Sumatera Utara' },
            { id: 4,'hc-key': 'id-ri', value: 25, name: 'Riau' },
            { id: 20,'hc-key': 'id-sw', value: 26, name: 'Sulawesi Utara' },
            { id: null,'hc-key': 'id-ku', value: 27, name: 'Kalimantan Utara' },
            { id: 27,'hc-key': 'id-la', value: 28, name: 'Maluku Utara' },
            { id: 3,'hc-key': 'id-sb', value: 29, name: 'Sumatera Barat' },
            { id: 26,'hc-key': 'id-ma', value: 30, name: 'Maluku' },
            { id: 14,'hc-key': 'id-nb', value: 31, name: 'Nusa Tenggara Barat' },
            { id: 23,'hc-key': 'id-sg', value: 32, name: 'Sulawesi Tenggara' },
            { id: 21,'hc-key': 'id-st', value: 33, name: 'Sulawesi Tengah' },
            { id: 29,'hc-key': 'id-pa', value: 34, name: 'Papua' },
            { id: 9,'hc-key': 'id-jr', value: 35, name: 'Jawa Barat' },
            { id: 19,'hc-key': 'id-ki', value: 36, name: 'Kalimantan Timur' },
            { id: 7,'hc-key': 'id-1024', value: 37, name: 'Lampung' },
            { id: null,'hc-key': 'id-jk', value: 38, name: 'Jakarta' },
            { id: 24,'hc-key': 'id-go', value: 39, name: 'Gorontalo' },
            { id: 11,'hc-key': 'id-yo', value: 40, name: 'Yogyakarta' },
            { id: 6,'hc-key': 'id-sl', value: 41, name: 'Sumatera Selatan' },
            { id: 25,'hc-key': 'id-sr', value: 42, name: 'Sulawesi Barat' },
            { id: 5,'hc-key': 'id-ja', value: 43, name: 'Jambi' },
            { id: 17,'hc-key': 'id-kt', value: 44, name: 'Kalimantan Tengah' }
        ];

        // Create the chart
        Highcharts.mapChart('mapindo', {
            chart: {
                map: topology
            },

            mapNavigation: {
                enabled: true,
                buttonOptions: {
                    verticalAlign: 'bottom'
                }
            },

            colorAxis: {
                min: 0,
                max: 75, // Rentang nilai data
                stops: [
                    [0, '#95be95'],     // tipis
                    [0.5, '#4c924c'],   // tengah
                    [1, '#006400']      // pekat
                ]
                
            },

            series: [{
                data: data,
                name: 'Sebaran KP',
                states: {
                    hover: {
                        color: '#e3eee3'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}',
                    style: {
                        fontFamily: 'Arial, sans-serif',
                        fontSize: '12px',
                        fontWeight: 'normal',
                        color: '#000000',
                        fontWeight: 'bold',
                        // textOutline: 'none'
                    }
                },

                point: {
                    events: {
                        click: function () {
                            // Arahkan ke halaman lain berdasarkan `hc-key`
                            const route = `/ip2sip/tabelPeta/${this.id}`;
                            window.location.href = route;  // Redirect ke halaman yang sesuai
                        }
                    }
                }
            }]
        });

        })();
    </script>
</div>

<div class="container profil-section">
    <h1>Profil Instalasi Penelitian dan Pengkajian Teknologi Pertanian KP.Gayo</h1>
        <div class="row">
            <div style="max-width: 400px; overflow: hidden;">
                <img src="/assets/img/kp-gayo.jpg" alt="Gambar BBPSIP">
                <p class="mt-2 text-center text-warning">
                    <b><span style="color: black;">📍 KP Aceh </span></b><br> 
                    <span style="color: green;">Kepala IP2SIP Aceh - Andi Supriyanto, S.Pt</span>
                </p>
            </div>
            <div style="max-width: 600px;">
                <p class="description">
                Sejarah singkat asal usul Kebun Percobaan ini berawal dari adanya proyek IDAP (1976-1986) kerjasana Indonesia dengan kerajoon Belanda. Pada tahun 1980 masyarakat petani kop di Aceh Tengah tergantung kehidupannya pada komoditi kopi sementora produksi hanya 500 kg/ hektar dalam setahun. Selain itu mutu kopi juga masih rendah akibat tidak adanya prosesing yang baik sehingga pada tahun 1984 dibangun pabrik prosesing kopi arabika. sengan kapas tas 15 ton kopi glondong nerah perharinya. Hal ini bertujuan untuk meningkatkan kualitas mutu kopi sehinggo meningkatkan pendapatan masyarakat tani sekitarnya. 
                </p>
            </div>
        </div>
</div>

@endsection
