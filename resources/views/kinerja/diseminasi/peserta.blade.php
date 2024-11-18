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
            margin-top: 20px;
        }
        .infographic {
            flex: 1;
            margin: 0 10px;
            text-align: center;
        }
        .icon-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 10px;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background-color: #f9f9f9;
        }
        .icon {
            font-size: 24px;
            color: #009144;
            margin: 2px;
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
            <h1>Dashboard Diseminasi Peserta</h1>
            <div class="infographics">
                <div class="infographic">
                    <h2>Jumlah Peserta</h2>
                    <p>120</p> 
                    <div class="icon-container">
                        @for ($i = 0; $i < 120; $i++)
                            <i class="fas fa-user icon"></i>
                        @endfor
                    </div>
                </div>
                <div class="infographic">
                    <h2>Sasaran Peserta</h2>
                    <p>100</p> 
                    <div class="icon-container">
                        @for ($i = 0; $i < 100; $i++)
                            <i class="fas fa-user icon"></i>
                        @endfor
                    </div>
                </div>
            </div>

            <a href="{{ route('diseminasi.form_peserta') }}" class="btn-form">Isi Form</a>

            <div class="map-container">
                <h2>Peta Sebaran Peserta per Provinsi</h2>
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
