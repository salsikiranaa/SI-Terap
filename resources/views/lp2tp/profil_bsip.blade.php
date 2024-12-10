@extends('layouts.layoutIp2tp')

@section('content')
<style>
    /* resources/css/custom.css */
    .header-image {
        position: relative;
        width: 100%;
        height: 16rem;
        object-fit: cover;
    }

    .header-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
    }

    .header-title {
        position: absolute;
        bottom: 1rem;
        left: 1rem;
        font-size: 1.875rem; /* text-3xl */
        font-weight: 700;    /* font-bold */
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
    }

    .card-content {
        padding: 2rem;
        gap: 1.5rem; /* space-y-6 */
    }

    .card-text {
        color: #4a5568; /* text-gray-700 */
        font-size: 1.125rem; /* text-lg */
    }

    .card-location {
        color: #2d3748; /* text-gray-800 */
        font-weight: 600;  /* font-semibold */
    }

    .card-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 1rem; /* space-x-4 */
    }

    .button-contact {
        background: #38a169; /* bg-green-600 */
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: background 0.3s ease;
    }

    .button-contact:hover {
        background: #2f855a; /* hover:bg-green-500 */
    }

    .button-back {
        color: #4a5568; /* text-gray-600 */
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .button-back:hover {
        color: #2d3748; /* hover:text-gray-800 */
    }
</style>
<div class="bg-gray-50 min-h-screen py-10 px-6">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Gambar BSIP -->
        <div class="header-image" style="background-image: url('{{ asset('assets/img/bsip-21.jpg') }}')">
            <div class="header-overlay"></div>
            <h2 class="header-title">SISTEM INFORMASI INSTALASI PENELITIAN DAN PENGKAJIAN TEKNOLOGI PERTANIAN (IP2TP) LINGKUP BBPSIP</h2>
        </div>

        <!-- Konten Detail -->
        <div class="card-content">
            <div class="space-y-4">
                <p class="card-text">
                    Balai Besar Pengkajian dan Pengembangan Teknologi Pertanian (BBP2TP) adalah Unit Pelaksana Teknis (UPT) di bidang pengkajian dan pengembangan teknologi pertanian yang berada di bawah dan bertanggungjawab kepada Kepala Badan Penelitian dan Pengembangan Pertanian. BBP2TP semula bernama Balai Pengkajian dan Pengembangan Teknologi Pertanian (BP2TP) yang berdiri berdasarkan Keputusan Menteri Pertanian nomor 77/Kpts/OT.210/1/2002, tanggal 29 Januari 2002 dan sejak terbitnya Peraturan Menteri Pertanian (Permentan) nomor 301/Kpts/OT.140/7/2005 tanggal 11 Juli 2005, BP2TP berubah menjadi Balai Besar Pengkajian dan Pengembangan Teknologi Pertanian.
                </p>
                <p class="card-text">
                    Kebun Percobaan lingkup BBP2TP berjumlah 60 KP yang tersebar di 28 BPTP. Pada tahun 2018 ada tiga KP yang baru, yaitu KP Kampar, KP Siak (BPTP Riau) dan KP Paal 16 (BPTP Jambi). Total luas KP lingkup BBP2TP adalah 2.569,47 Ha, dengan luasan rata-rata 45 Ha. Luasan KP ini bervariasi dari yang terkecil seluas 0,188 Ha (KP Wamena Papua) dan yang terbesar seluas 307 Ha (KP Makariki-Maluku).
                </p>
                <p class="card-text">
                    Lokasi Kebun Percobaan tersebar pada beberapa agroekosistem. Sebanyak 41 KP berada di lahan kering baik lahan kering di dataran rendah, dataran tinggi maupun berbukit, sedangkan 9 KP berada di lahan sawah, sisanya 7 KP berada di lahan lebak, rawa dan lahan pasang surut.
                </p>
                <p class="card-text">
                    Berdasarkan fungsinya maka pemanfaatan KP dapat dibedakan menjadi tiga kelompok besar yaitu pemanfaatan untuk kegiatan pengkajian/diseminasi, Unit Pengelola Benih Sumber (UPBS) dan Kerjasama Pemanfaatan KP dengan stakeholder. Hal ini sejalan dengan tugas dan fungsi utama BPTP di daerah sebagai lembaga yang bergerak dalam bidang pengkajian dan diseminasi hasil pengkajian. Tujuh puluh enam persen pemanfaatan KP ditujukan untuk kegiatan pengkajian dan diseminasi meliputi penelitian, ujicoba, pengembangan model penelitian, kebun produksi, koleksi plasma nutfah, koleksi sumberdaya genetik, pembibitan, kebun bibit induk, visitor plot, display teknologi unggulan, dan diseminasi lain seperti program jarwo super dan taman sains teknologi.
                </p>
                <p class="card-text">
                    Lahan KP sebagai lokasi untuk kegiatan litkaji perlu dipetakan dan ditata dengan baik dalam bentuk zonasi atau blok - blok sesuai dengan peruntukannya. Penataan lahan dalam bentuk blok - blok tersebut harus disesuaikan dengan kondisi dan kontur lahan yang ada. Hal tersebut diperlukan untuk memudahkan bagi para peneliti dan pengkaji dalam menentukan rancangan atau perlakuan terhadap tanaman atau komoditas yang diteliti. Di samping itu penataan lahan bermanfaat untuk menghindari terjadinya tumpang tindih dalam penggunaannya. Lahan yang digunakan untuk litkaji harus terpelihara dengan baik agar terhindar atau bebas dari kemungkinan terkontaminasi, gangguan hama dan penyakit serta faktor faktor lainnya yang dapat mempengaruhi keberhasilan kegiatan tersebut. Di samping itu lahan untuk kegiatan litkaji perlu dipilih pada area yang mempunyai sistem irigasi memadai. Lahan di KP yang tidak digunakan untuk kegiatan litkaji sebaiknya dimanfaatkan sebagai area penyangga, misalnya untuk tanaman produksi, perbanyakan tanaman pakan ternak atau kegiatan lainnya.
                </p>
                <p class="card-text">
                    Kebun percobaan selain untuk mendukung kegiatan litkaji, juga berfungsi sebagai lokasi konservasi koleksi plasma nutfah, yang diperbanyak melalui biji atau setek, lokasi konservasi tersebut dapat berfungsi untuk kegiatan rejunevasi dan karakterisasi. Penentuan lahan untuk untuk koleksi plasma nutfah atau sumberdaya genetik hendaknya disesuaikan dengan karakteristik komoditasnya, seperti kebutuhan syarat tumbuh atau sifat sifat khusus lainnya.
                </p>
            </div>

            <!-- Tombol Navigasi -->
            <div class="card-buttons">
                <a href="#" class="button-contact">Kontak</a>
                <a href="{{ route('dashboard-lp2tp') }}" class="button-back">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
