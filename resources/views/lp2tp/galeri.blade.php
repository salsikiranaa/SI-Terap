@extends('layouts.layoutIp2tp')

@section('content')
<style>
    /* Main Container Styling */
    .section-title {
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 3rem 0 2rem;
        position: relative;
        padding-bottom: 1rem;
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background-color: #28B96C;
    }
    
    .page-description {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 2.5rem;
        color: #555;
        font-size: 1.1rem;
        line-height: 1.6;
    }
    
    /* Gallery Grid Styling */
    .gallery-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .gallery-item {
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 250px;
    }
    
    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }
    
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .gallery-item:hover img {
        transform: scale(1.1);
    }
    
    .gallery-caption {
        position: absolute;
        bottom: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        color: #fff;
        width: 100%;
        text-align: center;
        padding: 15px 10px;
        font-size: 16px;
        font-weight: 500;
        opacity: 0.9;
        transition: opacity 0.3s ease;
    }
    
    .gallery-item:hover .gallery-caption {
        opacity: 1;
    }
    
    /* Modal Styling */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.75);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .modal.show {
        opacity: 1;
    }
    
    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.3);
        max-width: 800px;
        width: 90%;
        position: relative;
        transform: translateY(-20px);
        transition: transform 0.3s ease;
    }
    
    .modal.show .modal-content {
        transform: translateY(0);
    }
    
    .close {
        position: absolute;
        right: 20px;
        top: 15px;
        color: #666;
        font-size: 28px;
        font-weight: bold;
        transition: color 0.2s;
        cursor: pointer;
        z-index: 2;
    }
    
    .close:hover {
        color: #000;
    }
    
    #modalTitle {
        text-align: center;
        font-size: 1.8rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    
    #modalImage {
        display: block;
        max-width: 100%;
        max-height: 500px;
        margin: 0 auto 20px;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }
    
    #modalDescription {
        font-size: 1rem;
        line-height: 1.7;
        color: #444;
        text-align: justify;
    }
    
    /* Responsiveness */
    @media (max-width: 768px) {
        .gallery-container {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 15px;
        }
        
        .gallery-item {
            height: 200px;
        }
        
        #modalTitle {
            font-size: 1.5rem;
        }
        
        .section-title {
            font-size: 1.7rem;
            margin: 2rem 0 1.5rem;
        }
    }
</style>

<div class="container">
    <h2 class="section-title">Profil Kebun Percobaan (IP2SIP)</h2>
    <p class="page-description">
        Koleksi dokumentasi dari berbagai kegiatan dan fasilitas di Kebun Percobaan IP2SIP. 
        Klik pada gambar untuk melihat informasi lebih detail.
    </p>
    
    <div class="gallery-container">
        @foreach ($gallery as $gal)
            <div class="gallery-item" onclick="openModal('{{ $gal->title }}', '{{ $gal->image_url }}', 'Deskripsi kegiatan yang lebih panjang tentang {{ $gal->title }}. Sejarah singkat asal usul Kebun Percobaan ini berawal dari adanya proyek IDAP (1976-1986) kerjasama Indonesia dengan kerajaan Belanda. Pada tahun 1980 masyarakat petani kopi di Aceh Tengah tergantung kehidupannya pada komoditi kopi sementara produksi hanya 500 kg/hektar dalam setahun. Selain itu mutu kopi juga masih rendah akibat tidak adanya prosesing yang baik sehingga pada tahun 1984 dibangun pabrik prosesing kopi arabika dengan kapasitas 15 ton kopi glondong merah per harinya. Hal ini bertujuan untuk meningkatkan kualitas mutu kopi sehingga meningkatkan pendapatan masyarakat tani sekitarnya.')">
                <img src="{{ $gal->image_url }}" alt="{{ $gal->title }}">
                <div class="gallery-caption">{{ $gal->title }}</div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3 id="modalTitle">Nama Kegiatan</h3>
        <img id="modalImage" src="" alt="Kegiatan">
        <p id="modalDescription">Deskripsi Kegiatan</p>
    </div>
</div>

<script>
    // Open the modal and populate it with content
    function openModal(title, imageUrl, description) {
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalImage').src = imageUrl;
        document.getElementById('modalDescription').innerText = description;

        // Show the modal with animation
        const modal = document.getElementById('myModal');
        modal.style.display = "block";
        
        // Trigger reflow for animation
        void modal.offsetWidth;
        
        // Add show class for animation
        modal.classList.add('show');
    }

    // Close the modal
    function closeModal() {
        const modal = document.getElementById('myModal');
        modal.classList.remove('show');
        
        // Wait for animation to complete before hiding
        setTimeout(() => {
            modal.style.display = "none";
        }, 300); // Match this with CSS transition time
    }

    // Close the modal if the user clicks outside the modal content
    window.onclick = function(event) {
        if (event.target == document.getElementById('myModal')) {
            closeModal();
        }
    }
</script>
@endsection