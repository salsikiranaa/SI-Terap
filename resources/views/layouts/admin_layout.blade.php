<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Website</title>
    <style>
        body {
            display: flex;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        nav {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 20%;
            height: 100vh;
            background-color: #006400;
            overflow-y: scroll;
        }
        nav > div {
            padding: 10px 20px;
            color: #fff;
        }
        .nav-item {
            width: 100%;
            font-size: 16px;
            padding: 5px 0;
            text-decoration: none;
            color: #fff;
            background-color: #047c04;
            border-top: 1px solid #fff;
            border-bottom: 1px solid #fff;
            text-transform: capitalize;
        }
        .body-content {
            width: 100%;
            height: 100vh;
            overflow-y: scroll;
        }
        .body-content > div {
            padding: 10px 20px;
        }
        img {
            width: 100%;
        }
    </style>
</head>
@php
    $common = [
        ['name' => 'Jenis Standar', 'table' => 'm_jenis_standard'],
        ['name' => 'Kelompok Standar', 'table' => 'm_kelompok_standard'],
        ['name' => 'Lembaga', 'table' => 'm_lembaga'],
        ['name' => 'Metode', 'table' => 'm_metode'],
        ['name' => 'Sasaran', 'table' => 'm_sasaran'],
        ['name' => 'SIP', 'table' => 'm_sip'],
        ['name' => 'Komoditas', 'table' => 'm_komoditas'],
        ['name' => 'Kelas Benih', 'table' => 'm_kelas_benih'],
        ['name' => 'Fungsional', 'table' => 'm_fungsional'],
        ['name' => 'Jenis Lab', 'table' => 'm_jenis_lab'],
    ];
@endphp
<body>
    <nav>
        <div>
            <div>
                <a href="{{ route('home') }}">
                    <img src="/storage/cms/logo_light.png" alt="app logo">
                </a>
            </div>
            <br>
            <div>
                {{ auth()->user()->name }}
            </div>
            <br>
            <div style="display: flex;flex-direction:column;">
                <a href="{{ route('manage.service.view') }}" class="nav-item">service</a>
                <a href="{{ route('manage.accounts.view') }}" class="nav-item">accounts</a>
                <a href="{{ route('manage.provinsi.view') }}" class="nav-item">provinsi</a>
                <a href="{{ route('manage.kabupaten.view') }}" class="nav-item">kabupaten</a>
                <a href="{{ route('manage.kecamatan.view') }}" class="nav-item">kecamatan</a>
                <a href="{{ route('manage.bsip.view') }}" class="nav-item">BSIP</a>
                <a href="{{ route('manage.ip2sip.view') }}" class="nav-item">IP2SIP</a>
                <a href="{{ route('manage.cms.view') }}" class="nav-item">CMS</a>
                @foreach ($common as $cm)
                    <a href="{{ route('manage.data.common', ['name' => $cm['name'], 'table' => Crypt::encryptString($cm['table'])]) }}" class="nav-item">{{ $cm['name'] }}</a>
                @endforeach
            </div>
        </div>
        <div>
            <a href="{{ route('auth.logout') }}" class="nav-item">Logout</a>
        </div>
        <br><br>
    </nav>
    <div class="body-content">
        <div>
            @yield('content')
        </div>
    </div>
</body>
</html>