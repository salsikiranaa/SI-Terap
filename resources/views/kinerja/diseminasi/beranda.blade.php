@extends('layouts.layoutKinerja')

@section('content')
<style>
    .maincontainer {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    h1, h2, h3 {
        text-align: center;
        color: #006400;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 26px;
        font-weight: bold;
    }

    h2 {
        font-size: 18px;
    }

    h3 {
        font-size: 20px;
        font-weight: bold;
    }

    .filter-container {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    margin: 20px 0;
    }

    .filter-label {
    font-size: 16px;
    font-weight: bold;
    color: #00452C;
    margin-right: 8px;
    }

    .filter-input {
    width: 200px;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    }

    .filter-group {
    display: inline-block;
    }

    .page-title {
        font-size: 18px;
        font-weight: bold;
        color: #00452C;
    }

    .btn-filter {
        padding: 10px;
        background-color: #009144;
        color: #fff;
        font-size: 14px;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-filter:hover {
        background-color: #006400;
    }

    .infographics {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }

    .infographic {
        text-align: center;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        min-height: 200px;
    }

    .icon {
        font-size: 36px;
        color: #009144;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #00452C;
        color: white;
    }

    .button-container {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    .btn-form {
        padding: 10px 20px;
        background-color: #009144;
        color: #fff;
        font-size: 16px;
        text-align: center;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-form:hover {
        background-color: #006400;
    }

    .content.stylish-content {
        padding: 20px;
    }

    .stylish-button {
        display: block !important;
        width: fit-content;
        margin: 10px auto;
        padding: 10px 20px;
        color: white;
        background-color: #006633;
        text-decoration: none;
        border-radius: 5px;
        text-align: center;
        font-size: 1em;
        z-index: 1000;
        position: relative;
    }

    .stylish-button:hover {
        background-color: #009144;
    }

    .stylish-content {
        margin: 0 auto;
        max-width: 1200px;
        padding: 20px 10px; /* Mengurangi padding */
        background-color: #ffffff;
    }

    .map-container {
        padding: 20px; 
        background-color: #ffffff;
        border-radius: 0px; 
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
</style>

<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <div class="maincontainer">
        <h1>Dashboard Diseminasi SIP dan Peserta</h1>

        <div class="filter-container" style="margin-bottom: 20px; text-align: left; display: flex; align-items: center;">
                    <label for="sasaran-diseminasi" class="page-title" style="margin-right: 10px;">
                        Peta Sebaran Provinsi
                    </label>
                    <div class="filter-group" style="display: inline-block;">
                        <select id="sasaran-diseminasi" class="filter-input" style="width: 200px;">
                            <option value="">Semua Sasaran</option>
                            <option value="petani">Petani</option>
                            <option value="umkm">UMKM</option>
                            <option value="pelaku-usaha">Pelaku Usaha</option>
                            <option value="koperasi">Koperasi</option>
                            <option value="bumdes-bumd">BUMDes/BUMD</option>
                        </select>
                    </div>
                </div>

        <div class="content stylish-content">
            <h1 class="page-title">Peta Sebaran Identifikasi dan Inventarisasi SIP </h1>    
            <div class="map-container">
            <div class="map">      
                <div id="mapindo"></div>
                <a href="{{route('diseminasi.form_sektor')}}" class="stylish-button">Isi Form</a>
            </div>
        </div>

            <!-- Jumlah Peserta -->
            <h3>Jumlah Peserta</h3>
            <div class="infographic">
                <h2>Total Peserta</h2>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <p>120</p>
            </div>

            <!-- Sasaran Diseminasi -->
            <h3>Sasaran Diseminasi</h3>
            <div class="infographics">
                <!-- Target dan Pencapaian -->
                <div class="infographic">
                    <h2>Petani</h2>
                    <div class="icon"><i class="fas fa-tractor"></i></div>
                    <p>Target: 60</p>
                    <p>Pencapaian: 50 (83%)</p>
                </div>
                <div class="infographic">
                    <h2>UMKM</h2>
                    <div class="icon"><i class="fas fa-store"></i></div>
                    <p>Target: 40</p>
                    <p>Pencapaian: 30 (75%)</p>
                </div>
                <div class="infographic">
                    <h2>Pelaku Usaha</h2>
                    <div class="icon"><i class="fas fa-briefcase"></i></div>
                    <p>Target: 30</p>
                    <p>Pencapaian: 20 (67%)</p>
                </div>
                <div class="infographic">
                    <h2>Koperasi</h2>
                    <div class="icon"><i class="fas fa-handshake"></i></div>
                    <p>Target: 20</p>
                    <p>Pencapaian: 15 (75%)</p>
                </div>
                <div class="infographic">
                    <h2>BUMDes/BUMD</h2>
                    <div class="icon"><i class="fas fa-building"></i></div>
                    <p>Target: 10</p>
                    <p>Pencapaian: 5 (50%)</p>
                </div>
            </div>

            <!-- Filter Form -->
            <div class="filter-container">
                <div class="filter-group">
                    <select id="bpsip" name="bpsip" class="filter-input">
                        <option value="">BPSIP</option>
                        <option value="aceh">Aceh</option>
                        <option value="papua">Papua</option>
                    </select>
                </div>

                <div class="filter-group">
                    <input id="tanggal" type="month" name="tanggal" class="filter-input">
                </div>

                <div class="filter-group">
                    <select id="sip" name="sip" class="filter-input">
                        <option value="">SIP</option>
                        <option value="tp">TP</option>
                        <option value="horti">Horti</option>
                    </select>
                </div>

                <div class="filter-group">
                    <select id="jenis-standar" name="jenis-standar" class="filter-input">
                        <option value="">Jenis Standar</option>
                        <option value="sni">SNI</option>
                        <option value="iso">ISO</option>
                    </select>
                </div>

                <div class="filter-group">
                    <button type="submit" class="btn-filter">Filter</button>
                </div>
            </div>

            <!-- Kegiatan Table -->
            <table id="kegiatan-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>BPSIP</th>
                        <th>Tahun</th>
                        <th>SIP</th>
                        <th>Metode</th>
                        <th>Sasaran</th>
                        <th>Jumlah Sasaran</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <h3>SIP yang didiseminasikan</h3>
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
                        <h2>Perkebunan (Bun)</h2>
                        <div class="icon"><i class="fas fa-apple-alt"></i></div>
                        <p>Jumlah SNI: 10</p>
                        <p>Kelompok SNI: 2</p>
                    </div>
                    <div class="infographic">
                        <h2>Peternakan (Nak)</h2>
                        <div class="icon"><i class="fas fa-regular fa-cow"></i></div>
                        <p>Jumlah SNI: 12</p>
                        <p>Kelompok SNI: 4</p>
                    </div>
                    <div class="infographic">
                        <h2>Agroinput</h2>
                        <div class="icon"><i class="fas fa-sharp fa-solid fa-bag-seedling"></i></div>
                        <p>Jumlah SNI: 8</p>
                        <p>Kelompok SNI: 2</p>
                    </div>
                    <div class="infographic">
                        <h2>Pasca Panen (Paspa)</h2>
                        <div class="icon"><i class="fas fa-sharp-duotone fa-regular fa-tractor"></i></div>
                        <p>Jumlah SNI: 18</p>
                        <p>Kelompok SNI: 6</p>
                    </div>
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
                { 'hc-key': 'id-ac', value: 11, name: 'Aceh' },
                { 'hc-key': 'id-jt', value: 12, name: 'Jawa Tengah' },
                { 'hc-key': 'id-be', value: 13, name: 'Bengkulu' },
                { 'hc-key': 'id-bt', value: 14, name: 'Banten' },
                { 'hc-key': 'id-kb', value: 15, name: 'Kalimantan Barat' },
                { 'hc-key': 'id-bb', value: 16, name: 'Bangka Belitung' },
                { 'hc-key': 'id-ba', value: 17, name: 'Bali' },
                { 'hc-key': 'id-ji', value: 18, name: 'Jawa Timur' },
                { 'hc-key': 'id-ks', value: 19, name: 'Kalimantan Selatan' },
                { 'hc-key': 'id-nt', value: 20, name: 'Nusa Tenggara Timur' },
                { 'hc-key': 'id-se', value: 21, name: 'Sulawesi Selatan' },
                { 'hc-key': 'id-kr', value: 22, name: 'Kepulauan Riau' },
                { 'hc-key': 'id-ib', value: 23, name: 'Papua Barat' },
                { 'hc-key': 'id-su', value: 24, name: 'Sumatera Utara' },
                { 'hc-key': 'id-ri', value: 25, name: 'Riau' },
                { 'hc-key': 'id-sw', value: 26, name: 'Sulawesi Utara' },
                { 'hc-key': 'id-ku', value: 27, name: 'Kalimantan Utara' },
                { 'hc-key': 'id-la', value: 28, name: 'Maluku Utara' },
                { 'hc-key': 'id-sb', value: 29, name: 'Sumatera Barat' },
                { 'hc-key': 'id-ma', value: 30, name: 'Maluku' },
                { 'hc-key': 'id-nb', value: 31, name: 'Nusa Tenggara Barat' },
                { 'hc-key': 'id-sg', value: 32, name: 'Sulawesi Tenggara' },
                { 'hc-key': 'id-st', value: 33, name: 'Sulawesi Tengah' },
                { 'hc-key': 'id-pa', value: 34, name: 'Papua' },
                { 'hc-key': 'id-jr', value: 35, name: 'Jawa Barat' },
                { 'hc-key': 'id-ki', value: 36, name: 'Kalimantan Timur' },
                { 'hc-key': 'id-1024', value: 37, name: 'Lampung' },
                { 'hc-key': 'id-jk', value: 38, name: 'Jakarta' },
                { 'hc-key': 'id-go', value: 39, name: 'Gorontalo' },
                { 'hc-key': 'id-yo', value: 40, name: 'Yogyakarta' },
                { 'hc-key': 'id-sl', value: 41, name: 'Sumatera Selatan' },
                { 'hc-key': 'id-sr', value: 42, name: 'Sulawesi Barat' },
                { 'hc-key': 'id-ja', value: 43, name: 'Jambi' },
                { 'hc-key': 'id-kt', value: 44, name: 'Kalimantan Tengah' }
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
                    name: 'Jumlah Benih (ton)',
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
                                const route = `/diseminasi/provinsiDiseminasi/${this['hc-key']}`;
                                window.location.href = route;  // Redirect ke halaman yang sesuai
                            }
                        }
                    }
                }]
            });

            document.getElementById('sasaran-diseminasi').addEventListener('change', function() {
                const selectedValue = this.value;

                // Filter data sesuai sasaran diseminasi
                const filteredData = data.filter(point => {
                    if (!selectedValue) return true; // Jika semua sasaran dipilih
                    return point.name.toLowerCase().includes(selectedValue.toLowerCase());
                });

                // Perbarui peta dengan data yang difilter
                Highcharts.mapChart('mapindo', {
                    chart: { map: topology },
                    mapNavigation: { enabled: true, buttonOptions: { verticalAlign: 'bottom' } },
                    colorAxis: {
                        min: 0, max: 75,
                        stops: [[0, '#95be95'], [0.5, '#4c924c'], [1, '#006400']]
                    },
                    series: [{
                        data: filteredData,
                        name: 'Jumlah Benih (ton)',
                        states: { hover: { color: '#e3eee3' } },
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}',
                            style: {
                                fontFamily: 'Arial, sans-serif',
                                fontSize: '12px',
                                fontWeight: 'bold',
                                color: '#000000'
                            }
                        },
                        point: {
                            events: {
                                click: function () {
                                    const route = `/diseminasi/provinsiDiseminasi/${this['hc-key']}`;
                                    window.location.href = route;
                                }
                            }
                        }
                    }]
                });
            });

            })();
        </script>
    </div>
@endsection
