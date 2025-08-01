@extends('layouts.layoutIp2tp')

@section('content')
<style>
    body {
        background-color: #FFFFFF !important; /* Putih murni */
        overflow-x: hidden;
    }

    /* Container dan Layout Utama */
    .container {
        max-width: 1500px !important;
        width: 95%;
        padding-left: 15px;
        padding-right: 15px;
        margin-left: auto;
        margin-right: auto;
    }

    .profil-section {
        margin: 40px auto;
    }

    .stylish-content {
        width: 95%;
        max-width: 1500px;
        margin: 0 auto;
        padding: 20px 15px;
    }

    /* Peta Layout */
    #mapindo {
        height: 450px;
        width: 100%;
        margin: 0 auto 40px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 10px;
        border-radius: 10px;
    }

    /* Grid Layout untuk Profil Section */
    .profil-section .row {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        align-items: flex-start;
        justify-content: space-between;
    }

    .profil-section .row > div:first-child {
        flex: 0 1 350px;
        height: auto;
    }

    .profil-section .row > div:nth-child(2) {
        flex: 1 1 600px;
    }

    .no-shadow {
    border-radius: 0 !important;
    box-shadow: none !important;
}


    /* Typografi */
    .profil-section h1, .title-justify {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 25px;
        color: #185E53;
    }

    .title-justify {
        text-align: left;
    }

    .page-title {
        text-align: center;
        font-size: 24px;
        color: #185E53;
        margin: 20px 0;
        font-weight: bold;
    }

    .profil-section .description {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 25px;
        text-align: justify;
    }

    /* Carousel Styling */
    #carousel-siterap .carousel-item img {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }

    .carousel-caption h4 {
    font-weight: bold;
    }

    /* Gaya untuk indikator (titik-titik) */
    .carousel-indicators {
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
        z-index: 15;
        display: flex;
        justify-content: center;
        padding-left: 0;
        margin-right: 15%;
        margin-left: 15%;
        list-style: none;
    }
    
    .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 5px;
        margin-left: 5px;
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
        opacity: 0.8;
        transition: opacity 0.6s ease;
    }
    
    .carousel-indicators button.active {
        background-color: #fff;
        opacity: 1;
    }
    
    /* Menyesuaikan posisi caption agar tidak tumpang tindih dengan indikator */
    .carousel-caption {
        padding-bottom: 40px;
    }

    /* Stats Styling */
    .stats-container {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin: 15px 0 25px;
        gap: 15px;
    }

    .stat-card {
        flex: 1 1 160px;
        min-width: 160px;
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-left: 4px solid #28a745;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #28a745;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 15px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .stat-subtext {
        font-size: 13px;
        color: #666;
        margin-top: 5px;
        font-style: italic;
    }

    /* Tombol CTA */
    .cta-button-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .cta-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #28a745;
        color: white !important;
        text-decoration: none;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(40, 167, 69, 0.2);
        border: none;
    }

    .cta-button:hover {
        background-color: #218838;
        box-shadow: 0 6px 10px rgba(40, 167, 69, 0.3);
        transform: translateY(-2px);
    }

    .cta-button i {
        margin-left: 8px;
        transition: transform 0.3s ease;
    }

    .cta-button:hover i {
        transform: translateX(4px);
    }

    /* Gambar */
    .profil-section img {
        width: 100%;
        max-width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Highcharts Styling */
    .highcharts-title {
        opacity: 0 !important;
    }

    .highcharts-background {
        fill: #f4f4f4 !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5) !important;
    }

        /* Card Carousel Styling */
        .card-carousel-item {
        padding: 20px;
        margin: 10px auto;
        max-width: 1200px;
    }
    
    .profile-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        padding: 25px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }
    
    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }
    
    .card-img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        object-fit: cover;
    }
    
    .card-content {
        padding: 0 15px;
    }
    
    .card-content h4 {
        color: #185E53;
        font-weight: bold;
        margin-bottom: 15px;
        font-size: 20px;
    }
    
    /* Indikator untuk card carousel */
    .card-indicators {
        position: relative;
        bottom: -20px;
        margin-bottom: 40px;
    }
    
    .card-indicators button {
        background-color: rgba(40, 167, 69, 0.5);
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }
    
    .card-indicators button.active {
        background-color: #28a745;
    }
    
    /* Kontrol navigasi */
    /* Kontrol navigasi untuk card carousel - diubah agar berada di luar card */
#cardCarousel .carousel-control-prev,
#cardCarousel .carousel-control-next {
    width: 40px;
    height: 40px;
    background-color: rgba(40, 167, 69, 0.7);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    position: absolute;
}

#cardCarousel .carousel-control-prev {
    left: -10px; /* Pindah ke luar card di sisi kiri */
}

#cardCarousel .carousel-control-next {
    right: -10px; /* Pindah ke luar card di sisi kanan */
}

/* Tambahkan padding pada container carousel untuk memberikan ruang bagi tombol */
#cardCarousel {
    padding: 0 60px;
}
.profil-section h1 {
    margin-bottom: 10px;
}

#cardCarousel {
    margin-top: 10px;
}

@media (max-width: 768px) {
    #cardCarousel .carousel-control-prev {
        left: -30px; 
    }
    
    #cardCarousel .carousel-control-next {
        right: -30px; 
    }
    
    #cardCarousel {
        padding: 0 40px;
    }
}

@media (max-width: 576px) {
    #cardCarousel .carousel-control-prev {
        left: 5px; /* Pada layar kecil, tombol lebih dekat ke tepi */
        background-color: rgba(40, 167, 69, 0.5);
    }
    
    #cardCarousel .carousel-control-next {
        right: 5px; /* Pada layar kecil, tombol lebih dekat ke tepi */
        background-color: rgba(40, 167, 69, 0.5);
    }
    
    #cardCarousel {
        padding: 0 15px;
    }
}
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-carousel-item {
            padding: 10px;
        }
        
        .profile-card {
            padding: 15px;
        }
        
        .card-content {
            padding: 15px 0 0;
        }
        
        .card-content h4 {
            font-size: 18px;
        }
        
        #cardCarousel .carousel-control-prev,
        #cardCarousel .carousel-control-next {
            width: 30px;
            height: 30px;
        }
    }

    /* Responsiveness */
    @media (min-width: 1600px) {
        .container,
        .container.profil-section,
        .stylish-content {
            max-width: 1600px;
        }
    }

    @media (max-width: 992px) {
        .profil-section .row {
            justify-content: center;
        }
        
        .profil-section .row > div:first-child,
        .profil-section .row > div:nth-child(2) {
            flex: 0 1 100%;
        }
        
        .title-justify {
            text-align: center;
        }
        
        .cta-button-container {
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .profil-section h1, .title-justify, .page-title {
            font-size: 20px;
        }

        .profil-section .description {
            font-size: 15px;
        }

        .stats-container {
            justify-content: center;
        }
        
        .stat-card {
            min-width: 130px;
            flex-basis: calc(50% - 15px);
        }
        
        #carousel-siterap .carousel-item img {
            height: 300px;
        }

        #mapindo {
            height: 350px;
        }
    }

    @media (max-width: 480px) {
        .stat-card {
            flex-basis: 100%;
        }
        
        .container, .stylish-content {
            width: 100%;
            padding-left: 10px;
            padding-right: 10px;
        }
    }
</style>

<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- Carousel -->
<div id="carousel-siterap" class="carousel slide" data-bs-ride="carousel">
    <!-- Indikator (titik-titik) -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carousel-siterap" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carousel-siterap" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carousel-siterap" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/assets/img/kebun-gayo.png" class="d-block w-100" alt="slide 1">
            <div class="carousel-caption d-none d-md-block">
                <h4>Kebun Percobaan Gayo, Aceh</h4>
                <p>3°6'38",114°40'30",51.0m, 178°</p>
                <p>23/07/2018 13:40:18</p>
            </div>
        </div>
        
        <div class="carousel-item">
            <img src="/assets/img/sapi-gaponak.png" class="d-block w-100" alt="slide 2">
            <div class="carousel-caption d-none d-md-block">
                <h4>Gapoknak Wijaya Kusumah, Danda Jaya, Barito Kuala</h4>
                <p>3°6'38",114°40'30",51.0m, 178°</p>
                <p>23/07/2018 13:40:18</p>
            </div>
        </div>
        
        <div class="carousel-item">
            <img src="/assets/img/kebun-sitiung.png" class="d-block w-100" alt="slide 3">
            <div class="carousel-caption d-none d-md-block">
                <h4>Kebun Percobaan Sitiung, Sumatera Barat</h4>
                <p>3°6'38",114°40'30",51.0m, 178°</p>
                <p>23/07/2018 13:40:18</p>
            </div>
        </div>
    </div>

    <!-- Navigasi carousel (tombol prev/next) -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-siterap" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel-siterap" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Profil Section 1 -->
<div class="container" style="padding-top: 0; margin-top: 0; padding-left: 0; max-width: none; width: 100%;">
    <div class="row" style="margin-top: 0; margin-left: 0; display: flex; flex-wrap: nowrap;">
        <div style="padding: 0; margin-top: 0; margin-left: 0; flex: 0 0 450px; max-width: 450px;">
            <img src="/assets/img/profil-bbpsip.png" alt="Gambar BBPSIP" class="no-shadow" style="border-radius: 0; width: 100%; height: auto;">
        </div>
        <div style="padding-top: 40px; padding-left: 30px; flex: 1; max-width: calc(100% - 480px);">
            <h1 class="title-justify" style="font-size: 20px;">SISTEM INFORMASI INSTALASI PENELITIAN DAN PENGKAJIAN STANDAR INSTRUMEN PERTANIAN (IP2SIP) LINGKUP BPSIP</h1>
            <p class="description" style="font-size: 14px; line-height: 1.4; text-align: justify;">
                BPSIP (Balai Besar Penerapan Standar Instrumen Pertanian), yang sebelumnya bernama BBP2TP (Balai Besar Pengkajian dan Pengembangan Teknologi Pertanian),
                adalah UPT di bawah Badan Standardisasi Instrumen Pertanian, Kementerian Pertanian yang bertugas mengelola Kebun Percobaan di berbagai wilayah sebagai
                sarana pengkajian dan pengembangan teknologi pertanian.
            </p>
            <div class="stats-container" style="gap: 10px;">
                <div class="stat-card" style="flex: 1 1 120px; min-width: 120px; padding: 10px;">
                    <h3 class="stat-value" style="font-size: 24px;" id="count-ip2sip">0</h3>
                    <p class="stat-label" style="font-size: 13px;">IP2SIP</p>
                    <p class="stat-subtext" style="font-size: 11px;">(tersebar di 28 BPSIP)</p>
                </div>
                
                <div class="stat-card" style="flex: 1 1 120px; min-width: 120px; padding: 10px;">
                    <h3 class="stat-value" style="font-size: 24px;" id="count-hektar">0</h3>
                    <p class="stat-label" style="font-size: 13px;">Hektar</p>
                    <p class="stat-subtext" style="font-size: 11px;">Luas KP Lingkup BPSIP</p>
                </div>
                
                <div class="stat-card" style="flex: 1 1 120px; min-width: 120px; padding: 10px;">
                    <h3 class="stat-value" style="font-size: 24px;" id="count-terbesar">0</h3>
                    <p class="stat-label" style="font-size: 13px;">Luas kebun terbesar</p>
                    <p class="stat-subtext" style="font-size: 11px;">(KP Makariki - Maluku)</p>
                </div>
            </div>
            <div class="cta-button-container">
                <a href="{{ route('profil_bsip') }}" class="cta-button" style="padding: 8px 16px; font-size: 14px;">Info Selengkapnya <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan CountUp.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.8/countUp.min.js"></script>

<script>
// Tunggu hingga halaman sepenuhnya dimuat
window.onload = function() {
    // Jalankan animasi dengan delay kecil untuk memastikan DOM telah dirender
    setTimeout(function() {
        // Animasi untuk IP2SIP (dari 0 ke 60)
        animateValue("count-ip2sip", 0, 60, 2000);
        
        // Animasi untuk Hektar (dari 0 ke 2569.7)
        animateValue("count-hektar", 0, 2569.7, 2500, true);
        
        // Animasi untuk Luas kebun terbesar (dari 0 ke 307)
        animateValue("count-terbesar", 0, 307, 2000);
    }, 300);
};

// Fungsi animasi penghitungan
function animateValue(id, start, end, duration, isFormatted = false) {
    const obj = document.getElementById(id);
    if (!obj) return; // Pastikan elemen ditemukan
    
    const range = end - start;
    const minTimer = 50; // minimum interval (ms)
    let stepTime = Math.abs(Math.floor(duration / range));
    
    // Batasi stepTime ke minimal minTimer
    stepTime = Math.max(stepTime, minTimer);
    
    let startTime = new Date().getTime();
    let endTime = startTime + duration;
    let timer;
    
    function run() {
        let now = new Date().getTime();
        let remaining = Math.max((endTime - now) / duration, 0);
        let value = end - (remaining * range);
        
        // Format khusus untuk nilai Hektar
        if (isFormatted) {
            // Format angka menjadi format Indonesia (titik sebagai pemisah ribuan, koma sebagai desimal)
            let formattedValue = formatNumber(value);
            obj.innerHTML = formattedValue;
        } else {
            obj.innerHTML = Math.round(value);
        }
        
        if (Math.abs(value - end) < 0.5) {
            clearInterval(timer);
            // Pastikan menampilkan nilai akhir dengan tepat
            if (isFormatted) {
                obj.innerHTML = formatNumber(end);
            } else {
                obj.innerHTML = Math.round(end);
            }
        }
    }
    
    // Fungsi untuk memformat angka ke format Indonesia
    function formatNumber(num) {
        // Memisahkan bagian integer dan desimal
        let parts = num.toFixed(1).split('.');
        
        // Format bagian integer dengan titik sebagai pemisah ribuan
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        
        // Gabungkan kembali dengan koma sebagai pemisah desimal
        return parts.join(',');
    }
    
    timer = setInterval(run, stepTime);
    run();
}
</script>

<!-- Peta Section -->
<div class="stylish-content">
    <h1 class="page-title">Peta Sebaran Instalasi Penelitian dan Pengkajian Teknologi Pertanian di Indonesia</h1>    
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
            { id: 1,'hc-key': 'id-ac', value: 2, name: 'Aceh' },
            { id: 10,'hc-key': 'id-jt', value: 3, name: 'Jawa Tengah' },
            { id: null,'hc-key': 'id-be', value: 0, name: 'Bengkulu' },
            { id: 13,'hc-key': 'id-bt', value: 1, name: 'Banten' },
            { id: 16,'hc-key': 'id-kb', value: 3, name: 'Kalimantan Barat' },
            { id: 8,'hc-key': 'id-bb', value: 3, name: 'Bangka Belitung' },
            { id: null,'hc-key': 'id-ba', value: 0, name: 'Bali' },
            { id: 12,'hc-key': 'id-ji', value: 2, name: 'Jawa Timur' },
            { id: 18,'hc-key': 'id-ks', value: 4, name: 'Kalimantan Selatan' },
            { id: 15,'hc-key': 'id-nt', value: 4, name: 'Nusa Tenggara Timur' },
            { id: 22,'hc-key': 'id-se', value: 4, name: 'Sulawesi Selatan' },
            { id: null,'hc-key': 'id-kr', value: 0, name: 'Kepulauan Riau' },
            { id: 28,'hc-key': 'id-ib', value: 3, name: 'Papua Barat' },
            { id: 2,'hc-key': 'id-su', value: 2, name: 'Sumatera Utara' },
            { id: 4,'hc-key': 'id-ri', value: 2, name: 'Riau' },
            { id: 20,'hc-key': 'id-sw', value: 2, name: 'Sulawesi Utara' },
            { id: null,'hc-key': 'id-ku', value: 0, name: 'Kalimantan Utara' },
            { id: 27,'hc-key': 'id-la', value: 1, name: 'Maluku Utara' },
            { id: 3,'hc-key': 'id-sb', value: 4, name: 'Sumatera Barat' },
            { id: 26,'hc-key': 'id-ma', value: 1, name: 'Maluku' },
            { id: 14,'hc-key': 'id-nb', value: 3, name: 'Nusa Tenggara Barat' },
            { id: 23,'hc-key': 'id-sg', value: 2, name: 'Sulawesi Tenggara' },
            { id: 21,'hc-key': 'id-st', value: 1, name: 'Sulawesi Tengah' },
            { id: 29,'hc-key': 'id-pa', value: 2, name: 'Papua' },
            { id: 9,'hc-key': 'id-jr', value: 2, name: 'Jawa Barat' },
            { id: 19,'hc-key': 'id-ki', value: 2, name: 'Kalimantan Timur' },
            { id: 7,'hc-key': 'id-1024', value: 3, name: 'Lampung' },
            { id: null,'hc-key': 'id-jk', value: 0, name: 'Jakarta' },
            { id: 24,'hc-key': 'id-go', value: 1, name: 'Gorontalo' },
            { id: 11,'hc-key': 'id-yo', value: 1, name: 'Yogyakarta' },
            { id: 6,'hc-key': 'id-sl', value: 4, name: 'Sumatera Selatan' },
            { id: 25,'hc-key': 'id-sr', value: 0, name: 'Sulawesi Barat' },
            { id: 5,'hc-key': 'id-ja', value: 1, name: 'Jambi' },
            { id: 17,'hc-key': 'id-kt', value: 1, name: 'Kalimantan Tengah' }
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
                max: 5, // Rentang nilai data
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

<!-- Card Carousel Profil IP2SIP -->
<div class="container profil-section">
    <h1 style="text-align: center">Profil Instalasi Penelitian dan Pengkajian Standar Instrumen Pertanian</h1>
    
    <div id="cardCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Indikator (titik-titik) -->
        <div class="carousel-indicators card-indicators">
            <button type="button" data-bs-target="#cardCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#cardCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#cardCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        
        <div class="carousel-inner">
            <!-- Card 1 -->
            <div class="carousel-item active">
                <div class="card-carousel-item">
                    <div class="row profile-card">
                        <div class="col-md-5">
                            <img src="/assets/img/kp-gayo.jpg" alt="Gambar KP Gayo" class="card-img">
                            <p class="mt-3 text-center">
                                <span style="color: green;">Kepala IP2SIP Aceh - Andi Supriyanto, S.Pt</span>
                            </p>
                        </div>
                        <div class="col-md-7">
                            <div class="card-content">
                                <h4>Kebun Percobaan Gayo, Aceh</h4>
                                <p class="description">
                                    Sejarah singkat asal usul Kebun Percobaan ini berawal dari adanya proyek IDAP (1976-1986) kerjasana Indonesia dengan kerajoon Belanda. Pada tahun 1980 masyarakat petani kop di Aceh Tengah tergantung kehidupannya pada komoditi kopi sementora produksi hanya 500 kg/ hektar dalam setahun. Selain itu mutu kopi juga masih rendah akibat tidak adanya prosesing yang baik.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="carousel-item">
                <div class="card-carousel-item">
                    <div class="row profile-card">
                        <div class="col-md-5">
                            <img src="/assets/img/kp-maluku.jpg" alt="Gambar KP Makariki" class="card-img" style="max-height: 200px; object-fit: cover;">
                            <p class="mt-3 text-center">
                                <span style="color: green;">Kepala IP2SIP Maluku - Budi Santoso, SP</span>
                            </p>
                        </div>
                        <div class="col-md-7">
                            <div class="card-content">
                                <h4>Kebun Percobaan Makariki, Maluku</h4>
                                <p class="description">
                                    Kebun Percobaan Makariki adalah kebun terbesar lingkup BPSIP dengan luas 307 hektar. Kebun ini menjadi pusat pengembangan tanaman perkebunan dan pangan di wilayah Maluku. KP Makariki memiliki keunggulan pada pengembangan komoditas cengkeh, pala, dan kelapa yang merupakan tanaman unggulan daerah Maluku.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      
            <!-- Card 3 -->
<div class="carousel-item">
    <div class="card-carousel-item">
        <div class="row profile-card">
            <div class="col-md-5">
                <img src="/assets/img/kp-maluku.jpg" alt="Gambar KP Lempake" class="card-img" style="max-height: 200px; object-fit: cover;">
                <p class="mt-3 text-center">
                    <span style="color: green;">Kepala IP2SIP Kalimantan Timur - Zainal Abidin, SP., M.Si</span>
                </p>
            </div>
            <div class="col-md-7">
                <div class="card-content">
                    <h4>Kebun Percobaan Lempake, Kalimantan Timur</h4>
                    <p class="description">
                        Kebun Percobaan Sitiung merupakan salah satu pusat pengembangan teknologi pertanian di Kalimantan Timur. Kebun ini fokus pada pengembangan komoditas tanaman pangan seperti padi dan jagung, serta tanaman hortikultura. KP Sitiung juga menjadi sentra pelatihan bagi petani di sekitar wilayah Kalimantan Timur.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>  
</div>
 <!-- Navigasi carousel (tombol prev/next) -->
 <button class="carousel-control-prev" type="button" data-bs-target="#cardCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#cardCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>
</div>

<!-- Semua konten lain... -->

<!-- Script untuk mengatur autoplay dan interval carousel -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var cardCarousel = new bootstrap.Carousel(document.getElementById('cardCarousel'), {
            interval: 5000,
            wrap: true
        });
    });
    </script>
@endsection