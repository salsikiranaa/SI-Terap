@extends('layouts.layoutIp2tp')

@section('content')
<style>
    /* Header section with background - Full width */
    .header-section {
        background: linear-gradient(135deg, #00452C 0%, #006B44 100%);
        padding: 40px 0px 240px 0px;
        text-align: center;
        position: relative;
        margin-bottom: -200px;
        z-index: 1;
        width: 100%;
    }
    
        body {
        background-color: #ffffff;
    }

    .profile-title {
        font-size: 28px;
        font-weight: bold;
        color: #fff;
        margin-bottom: 10px;
        line-height: 1.3;
        text-transform: none;
        letter-spacing: 0.5px;
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .subtitle {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 400;
    }
    
    /* Image container - Centered and consistent padding */
    .image-container {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
        padding: 0 20px;
        position: relative;
        z-index: 2;
        max-width: 1140px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .profile-image {
        max-width: 1100px;
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }
    
    .content-section {
        max-width: 1140px;
        margin: 0 auto;
        padding: 40px 20px; /* atas dan bawah jadi ada padding */
        background-color: #fff;
        width: 100%;
    }

        
    .content-title {
        font-size: 22px;
        color: #00452C;
        margin-bottom: 20px;
        font-weight: 600;
        border-left: 4px solid #00452C;
        padding-left: 15px;
    }
    
    .profile-description {
        font-size: 16px;
        line-height: 1.8;
        color: #444;
        text-align: justify;
        margin-bottom: 24px;
    }
    
    .profile-description:last-child {
        margin-bottom: 0;
    }
    
    /* Card sections */
    .info-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }
    
    .info-card {
        padding: 20px;
        background-color: #F8F5F5;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        border-top: 3px solid #00452C;
    }
    
    .info-card h3 {
        font-size: 18px;
        color: #00452C;
        margin-bottom: 10px;
    }
    
    .info-card p {
        font-size: 15px;
        line-height: 1.6;
        color: #555;
    }
    
    /* Divider */
    .divider {
        height: 1px;
        background: linear-gradient(to right, rgba(0, 69, 44, 0), rgba(0, 69, 44, 0.5), rgba(0, 69, 44, 0));
        margin: 30px 0;
    }
    
    /* Footer section */
    .footer-section {
        background-color: #fff;
        padding: 30px 50px;
        text-align: center;
    }

    /* Responsive Design - Konsistensi padding di semua breakpoint */
    @media (max-width: 1200px) {
        .content-section {
            max-width: 1040px;
            padding: 0 20px;
        }
        
        .image-container {
            max-width: 1040px;
            padding: 0 20px;
        }
        
        .profile-image {
            max-width: 1000px;
        }
        
        .profile-title {
            padding: 0 20px;
        }
    }

    @media (max-width: 1024px) {
        .content-section {
            max-width: 940px;
            padding: 0 20px;
        }
        
        .image-container {
            max-width: 940px;
            padding: 0 20px;
        }
        
        .header-section {
            padding: 35px 0px 200px 0px;
            margin-bottom: -160px;
        }
        
        .profile-title {
            font-size: 26px;
            padding: 0 20px;
        }
        
        .content-title {
            font-size: 20px;
        }
        
        .info-cards {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 18px;
        }
        
        .profile-image {
            max-width: 900px;
            height: 350px;
        }
    }

    @media (max-width: 768px) {
        .content-section {
            padding: 0 20px;
        }
        
        .image-container {
            padding: 0 20px;
        }

        .header-section {
            padding: 30px 0px 160px 0px;
            margin-bottom: -120px;
        }
        
        .profile-title {
            font-size: 22px;
            line-height: 1.4;
            padding: 0 20px;
        }

        .content-title {
            font-size: 19px;
            margin-bottom: 18px;
        }

        .profile-description {
            font-size: 15px;
            line-height: 1.7;
            text-align: left;
            margin-bottom: 20px;
        }

        .info-cards {
            grid-template-columns: 1fr;
            gap: 15px;
            margin: 25px 0;
        }

        .info-card {
            padding: 18px;
        }

        .info-card h3 {
            font-size: 17px;
            margin-bottom: 8px;
        }

        .info-card p {
            font-size: 14px;
            line-height: 1.5;
        }

        .profile-image {
            max-width: 100%;
            height: 280px;
        }

        .divider {
            margin: 25px 0;
        }

        .footer-section {
            padding: 25px 20px;
        }
    }

    @media (max-width: 600px) {
        .content-section {
            padding: 0 20px;
        }
        
        .image-container {
            padding: 0 50px;
        }

        .header-section {
            padding: 25px 0px 120px 0px;
            margin-bottom: -80px;
        }
        
        .profile-title {
            font-size: 20px;
            line-height: 1.3;
            padding: 0 20px;
        }

        .content-title {
            font-size: 18px;
            margin-bottom: 15px;
            padding-left: 12px;
        }

        .profile-description {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .info-cards {
            margin: 20px 0;
            gap: 12px;
        }

        .info-card {
            padding: 15px;
        }

        .info-card h3 {
            font-size: 16px;
            margin-bottom: 6px;
        }

        .info-card p {
            font-size: 13px;
            line-height: 1.4;
        }

        .profile-image {
            max-width: 100%;
            height: 220px;
        }

        .divider {
            margin: 20px 0;
        }

        .footer-section {
            padding: 20px 15px;
        }
    }

    @media (max-width: 480px) {
        .content-section {
            padding: 0 20px;
        }
        
        .image-container {
            padding: 0 20px;
        }

        .header-section {
            padding: 20px 0px 100px 0px;
            margin-bottom: -60px;
        }
        
        .profile-title {
            font-size: 18px;
            line-height: 1.2;
            padding: 0 20px;
        }

        .content-title {
            font-size: 17px;
            margin-bottom: 12px;
            padding-left: 10px;
            border-left-width: 3px;
        }

        .profile-description {
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .info-cards {
            margin: 18px 0;
            gap: 10px;
        }

        .info-card {
            padding: 12px;
            border-top-width: 2px;
        }

        .info-card h3 {
            font-size: 15px;
            margin-bottom: 5px;
        }

        .info-card p {
            font-size: 12px;
            line-height: 1.3;
        }

        .profile-image {
            height: 180px;
        }

        .divider {
            margin: 15px 0;
        }

        .footer-section {
            padding: 15px 12px;
        }
    }
</style>

<div class="header-section">
    <h1 class="profile-title">Sistem Informasi Instalasi Penelitian dan Pengkajian Standar Instrumen Pertanian IP2SIP Lingkup BPSIP</h1>
</div>

<!-- Image Section -->
<div class="image-container">
    <img src="{{ asset('assets/img/bsip-21.jpg') }}" alt="Foto BBPSIP" class="profile-image">
</div>

<!-- Content Section -->
<div class="content-section">
    <h2 class="content-title">Tentang BBP2TP</h2>
    <p class="profile-description">
        Balai Besar Pengkajian dan Pengembangan Teknologi Pertanian (BBP2TP) adalah Unit Pelaksana Teknis (UPT) di bidang pengkajian dan pengembangan teknologi pertanian yang berada di bawah dan bertanggungjawab kepada Kepala Badan Penelitian dan Pengembangan Pertanian. BBP2TP semula bernama Balai Pengkajian dan Pengembangan Teknologi Pertanian (BP2TP) yang berdiri berdasarkan Keputusan Menteri Pertanian nomor 77/Kpts/OT.210/1/2002, tanggal 29 Januari 2002 dan sejak terbitnya Peraturan Menteri Pertanian (Permentan) nomor 301/Kpts/OT.140/7/2005 tanggal 11 Juli 2005, BP2TP berubah menjadi Balai Besar Pengkajian dan Pengembangan Teknologi Pertanian.
    </p>
    
    <div class="divider"></div>
    
    <h2 class="content-title">Kebun Percobaan</h2>
    
    <div class="info-cards">
        <div class="info-card">
            <h3>Jumlah & Sebaran</h3>
            <p>Kebun Percobaan lingkup BBP2TP berjumlah 60 KP yang tersebar di 28 BPTP. Pada tahun 2018 ada tiga KP yang baru, yaitu KP Kampar, KP Siak (BPTP Riau) dan KP Paal 16 (BPTP Jambi).</p>
        </div>
        <div class="info-card">
            <h3>Luasan Area</h3>
            <p>Total luas KP lingkup BBP2TP adalah 2.569,47 Ha, dengan luasan rata-rata 45 Ha. Luasan KP ini bervariasi dari yang terkecil seluas 0,188 Ha (KP Wamena Papua) dan yang terbesar seluas 307 Ha (KP Makariki-Maluku).</p>
        </div>
    </div>
    
    <p class="profile-description">
        Lokasi Kebun Percobaan tersebar pada beberapa agroekosistem. Sebanyak 41 KP berada di lahan kering baik lahan kering di dataran rendah, dataran tinggi maupun berbukit, sedangkan 9 KP berada di lahan sawah, sisanya 7 KP berada di lahan lebak, rawa dan lahan pasang surut.
    </p>
    
    <div class="divider"></div>
    
    <h2 class="content-title">Fungsi dan Pemanfaatan</h2>
    <p class="profile-description">
        Berdasarkan fungsinya maka pemanfaatan KP dapat dibedakan menjadi tiga kelompok besar yaitu pemanfaatan untuk kegiatan pengkajian/diseminasi, Unit Pengelola Benih Sumber (UPBS) dan Kerjasama Pemanfaatan KP dengan stakeholder. Hal ini sejalan dengan tugas dan fungsi utama BPTP di daerah sebagai lembaga yang bergerak dalam bidang pengkajian dan diseminasi hasil pengkajian. Tujuh puluh enam persen pemanfaatan KP ditujukan untuk kegiatan pengkajian dan diseminasi meliputi penelitian, ujicoba, pengembangan model penelitian, kebun produksi, koleksi plasma nutfah, koleksi sumberdaya genetik, pembibitan, kebun bibit induk, visitor plot, display teknologi unggulan, dan diseminasi lain seperti program jarwo super dan taman sains teknologi.
    </p>
    
    <p class="profile-description">
        Lahan KP sebagai lokasi untuk kegiatan litkaji perlu dipetakan dan ditata dengan baik dalam bentuk zonasi atau blok - blok sesuai dengan peruntukannya. Penataan lahan dalam bentuk blok - blok tersebut harus disesuaikan dengan kondisi dan kontur lahan yang ada. Hal tersebut diperlukan untuk memudahkan bagi para peneliti dan pengkaji dalam menentukan rancangan atau perlakuan terhadap tanaman atau komoditas yang diteliti. Di samping itu penataan lahan bermanfaat untuk menghindari terjadinya tumpang tindih dalam penggunaannya.
    </p>
    
    <p class="profile-description">
        Lahan yang digunakan untuk litkaji harus terpelihara dengan baik agar terhindar atau bebas dari kemungkinan terkontaminasi, gangguan hama dan penyakit serta faktor faktor lainnya yang dapat mempengaruhi keberhasilan kegiatan tersebut. Di samping itu lahan untuk kegiatan litkaji perlu dipilih pada area yang mempunyai sistem irigasi memadai. Lahan di KP yang tidak digunakan untuk kegiatan litkaji sebaiknya dimanfaatkan sebagai area penyangga, misalnya untuk tanaman produksi, perbanyakan tanaman pakan ternak atau kegiatan lainnya.
    </p>
    
    <div class="divider"></div>
    
    <h2 class="content-title">Konservasi Plasma Nutfah</h2>
    <p class="profile-description">
        Kebun percobaan selain untuk mendukung kegiatan litkaji, juga berfungsi sebagai lokasi konservasi koleksi plasma nutfah, yang diperbanyak melalui biji atau setek, lokasi konservasi tersebut dapat berfungsi untuk kegiatan rejunevasi dan karakterisasi. Penentuan lahan untuk untuk koleksi plasma nutfah atau sumberdaya genetik hendaknya disesuaikan dengan karakteristik komoditasnya, seperti kebutuhan syarat tumbuh atau sifat sifat khusus lainnya.
    </p>
</div>
@endsection