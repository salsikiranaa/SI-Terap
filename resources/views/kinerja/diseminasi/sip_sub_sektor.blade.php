@extends('layouts.header_navbar_footer')

@section('content')
    <style>
        .dashboard {
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #009144;
        }
        .infographics {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .infographic {
            flex: 1 1 30%;
            margin: 10px;
            text-align: center;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .icon {
            font-size: 48px;
            color: #009144;
        }
        .map-container {
            margin-top: 20px;
        }
        .btn-form {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #009144;
            color: #ffffff;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }
    </style>

    <section class="dashboard">
        <div class="container">
            <h1>Dashboard SIP per Sub Sektor</h1>
            <div class="infographics">
                <div class="infographic">
                    <h2>Tanaman Pangan (TP)</h2>
                    <div class="icon"><i class="fas fa-seedling"></i></div>
                    <p>Jumlah SNI: 20</p> 
                    <p>Kelompok SNI: 5</p> 
                </div>
                <div class="infographic">
                    <h2>Hortikultura (Horti)</h2>
                    <div class="icon"><i class="fas fa-carrot"></i></div>
                    <p>Jumlah SNI: 15</p>
                    <p>Kelompok SNI: 3</p>
                </div>
                <div class="infographic">
                    <h2>Buah-Buahan (Bun)</h2>
                    <div class="icon"><i class="fas fa-apple-alt"></i></div>
                    <p>Jumlah SNI: 10</p>
                    <p>Kelompok SNI: 2</p>
                </div>
                <div class="infographic">
                    <h2>Peternakan (Nak)</h2>
                    <div class="icon"><i class="fas fa-piggy-bank"></i></div>
                    <p>Jumlah SNI: 12</p>
                    <p>Kelompok SNI: 4</p>
                </div>
                <div class="infographic">
                    <h2>Agroinput</h2>
                    <div class="icon"><i class="fas fa-cogs"></i></div>
                    <p>Jumlah SNI: 8</p>
                    <p>Kelompok SNI: 2</p>
                </div>
                <div class="infographic">
                    <h2>Pasar Pertanian (Paspa)</h2>
                    <div class="icon"><i class="fas fa-store"></i></div>
                    <p>Jumlah SNI: 18</p>
                    <p>Kelompok SNI: 6</p>
                </div>
            </div>

            <a href="{{ route('diseminasi.form_sektor') }}" class="btn-form">Isi Form</a>

            <div class="map-container">
                <h2>Peta Sebaran SIP</h2>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.5443994375355!2d106.78557271018322!3d-6.5790339933869735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5311ad80031%3A0xae42de3ba17aceb7!2sBalai%20Besar%20Penerapan%20Standar%20Instrumen%20Pertanian%20(BBPSIP)!5e0!3m2!1sen!2sid!4v1722608683905!5m2!1sen!2sid"
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
