<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI TERAP - BBPSIP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        .navbar {
            display: flex;
            max-width: 100%;
            height: 75px;
            padding: 0px 20px;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            border-bottom: 1px solid #ddd;
            position: fixed;
            width: 100%;
            z-index: 999;
        }

        .navbar-brand img {
            width: 200px;
        }
        .hero-section {
            background-image: url('/assets/img/bsip_depan.png');
            background-size: cover;
            background-position: center;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            margin-bottom: 50px;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.75rem;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 3rem;
            }

            .hero p {
                font-size: 1.25rem;
            }
        }

        .custom-button {
            display: inline-block;
            padding: 5px 20px;
            border-radius: 10px;
            border: 2px solid green;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
        }

        .custom-button.daftar {
            margin-right: 10px;
            background-color: white;
            color: green;
        }

        .custom-button.masuk {
            background-color: green;
            color: white;
        }

        .custom-button:hover {
            background-color: green;
            color: white;
        }
        .services .card {
            border: none;
        }
        .footer {
            background-image: linear-gradient(to right, #006400, rgb(37, 148, 116));
            color: white;
            padding: 40px 0;
        }
        footer .contact-info p a {
            color: white;
            text-decoration: none;
        }
        footer .social-links {
        margin-top: 10px;
        }
        footer .social-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        footer .social-links a:hover {
            text-decoration: underline;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Tambahkan bayangan */
            border-color: #006400 !important;
            border-width: 1px !important;
        }
        .card{
            border-radius: 10px;
            padding: 2px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <a class="navbar-brand" href="#">
            <img src="/assets/img/logo_green.png" alt="Logo">
        </a>
        <ul class="navbar-nav ml-auto">
            <li><button class="custom-button daftar">Daftar</button></li>
            <li><button class="custom-button masuk">Masuk</button></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero">
            <h1>SI TERAP</h1>
            <p>Portal Sistem Informasi Terpadu Balai Besar Penerapan Standar Instrumen Pertanian</p>
        </div>
    </div>

    <!-- Services Section -->
    <section class="services py-5">
        <div class="container text-center">
            <h2 class="mb-5"><b>Layanan</b></h2>
            <div class="row d-flex justify-content-center">
                <div class="col-md-2">
                    <a href="#" style="text-decoration: none">
                        <div class="card border" style="border: 10px">
                            <img src="https://img.freepik.com/free-vector/statistical-data-research-company-performance-indicators-return-investment-percentage-ratio-indexes-fluctuation-significative-change_335657-1165.jpg?t=st=1730187597~exp=1730191197~hmac=424ad0cd8b99667514e8edd11b892ed3ad446e241525bdda6789f6c64167f256&w=740" alt="Kinerja Kegiatan" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Kinerja Kegiatan</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" style="text-decoration: none">
                        <div class="card border">
                            <img src="https://img.freepik.com/free-vector/business-audit-financial-specialist-cartoon-character-with-magnifier-examination-statistical-graphic-information-statistics-diagram-chart_335657-834.jpg?t=st=1730188656~exp=1730192256~hmac=4e5713040e496c8a7f0130c0651f08f1fbb0e456055e79d4e4d5cbbb4adfd42f&w=740" alt="Lab Pengujian" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Lab Pengujian <br></h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" style="text-decoration: none">
                        <div class="card border">
                            <img src="https://img.freepik.com/free-vector/bug-fixing-software-testing-computer-virus-searching-tool-devops-web-optimization-antivirus-app-magnifier-cogwheel-monitor-design-element_335657-211.jpg?t=st=1730187126~exp=1730190726~hmac=66b3253705fcec65c36d963573a90c2fae0a167433173ae3ad9caee35e6ce6cc&w=740" alt="Perbenihan" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Perbenihan</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" style="text-decoration: none">
                        <div class="card border">
                            <img src="https://img.freepik.com/free-vector/customer-self-service-abstract-concept-illustration-e-support-system-electronic-proactive-customer-online-assistance-faqs-knowledge-base-representative-free-shop_335657-46.jpg?t=st=1730188492~exp=1730192092~hmac=55fb09f5873e946b328714bdf21ecfbbc27f923aa61231d0886288681d96a534&w=740" alt="IP2SIP" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">IP2SIP</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="#" style="text-decoration: none">
                        <div class="card border">
                            <img src="https://img.freepik.com/free-vector/dashboard-analytics-computer-performance-evaluation-chart-screen-statistics-analysis-infographic-assessment-business-report-display-isolated-concept-metaphor-illustration_335657-1149.jpg?t=st=1730188574~exp=1730192174~hmac=062d414ad7f4ba7ea2bff35402cca9842a482fe9ff3607cbf442e81a40e3b083&w=740" alt="Direktori SDM Penyuluh" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Direktori SDM Penyuluh</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.5443994375355!2d106.78557271018322!3d-6.5790339933869735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5311ad80031%3A0xae42de3ba17aceb7!2sBalai%20Besar%20Penerapan%20Standar%20Instrumen%20Pertanian%20(BBPSIP)!5e0!3m2!1sen!2sid!4v1722608683905!5m2!1sen!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-md-6">
                    <div class="contact-info">
                        <p><b>KONTAK</b></p>
                        <p><a href="tel:+6202518531727"></a>(0251) 8531727 | WA : <a href="https://wa.me/085282828696">085282828696</a></p>
                        <p>Email: <a href="mailto:bbpsip@apps.pertanian.go.id">bbpsip@apps.pertanian.go.id</a></p>
                        <p>Jl. Tentara Pelajar No.10, RT.04/RW.07, Ciwaringin, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16124</p>
    
                        <p><a href="https://bbpsip.bsip.pertanian.go.id" target="_blank">https://bbpsip.bsip.pertanian.go.id</a></p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/BSIPPenerapan/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.youtube.com/@bsippenerapan" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="https://instagram.com/bsippenerapan" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/bsippenerapan" target="_blank"><i class="fab fa-x-twitter"></i></a>
                        <a href="https://tiktok.com/@bsippenerapan" target="_blank"><i class="fab fa-tiktok"></i></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>