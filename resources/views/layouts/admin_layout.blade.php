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
            border-left: none;
            border-right: none;
            text-align: left;
            text-transform: capitalize;
        }
        .group-child {
            margin-left: 10px;
        }
        .nav-child {
            font-size: 16px;
            padding: 5px 0;
            text-decoration: none;
            color: #fff;
            background-color: #047c04;
            border-top: 0.3px solid #fff;
            border-bottom: 0.3px solid #fff;
            border-left: none;
            border-right: none;
            text-align: left;
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
                <a href="{{ route('manage.dashboard') }}" class="nav-item">Dashboard</a>
                <a href="{{ route('manage.service.view') }}" class="nav-item">Service</a>
                <a href="{{ route('manage.accounts.view') }}" class="nav-item">Accounts</a>
                <a href="{{ route('manage.cms.view') }}" class="nav-item">App Management</a>
                <button class="nav-item" onclick="showRegion()">Region &#11206;</button>
                <div id="region" class="group-child" style="display: none;flex-direction:column;">
                    <a href="{{ route('manage.provinsi.view') }}" class="nav-item">Provinsi</a>
                    <a href="{{ route('manage.kabupaten.view') }}" class="nav-item">Kabupaten</a>
                    <a href="{{ route('manage.kecamatan.view') }}" class="nav-item">Kecamatan</a>
                </div>
                <button class="nav-item" onclick="showCommon()">Common &#11206;</button>
                <div id="common" class="group-child" style="display: none;flex-direction:column;">
                    <a href="{{ route('manage.bsip.view') }}" class="nav-child">BSIP</a>
                    <a href="{{ route('manage.ip2sip.view') }}" class="nav-child">IP2SIP</a>
                    @foreach ($common as $cm)
                        <a href="{{ route('manage.data.common', ['name' => $cm['name'], 'table' => Crypt::encryptString($cm['table'])]) }}" class="nav-child">{{ $cm['name'] }}</a>
                    @endforeach
                </div>
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

    <script>
        const showCommon = () => {
            const common = document.getElementById('common');
            common.style.display = common.style.display === 'flex' ? 'none' : 'flex';
        }
        const showRegion = () => {
            const region = document.getElementById('region');
            region.style.display = region.style.display === 'flex' ? 'none' : 'flex';
        }
    </script>
</body>
</html>