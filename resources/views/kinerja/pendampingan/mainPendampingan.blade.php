@extends('layouts.layoutKinerja')

@section('content')
<style>
    .anchor-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .content.stylish-content {
        padding: 20px;
    }

    .page-title {
        text-align: center;
        font-size: 2em;
        color: #00452C;
        margin: 20px 0;
    }

    .page-item {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 25px;
        height: 25px;
        border: 1.5px solid #00452C; 
        color: #00452C;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .stylish-button {
        display: block;
        width: fit-content;
        padding: 12px 25px;
        color: white;
        background-color: #006633;
        text-decoration: none;
        border-radius: 5px;
        text-align: center;
        font-size: 1.1em;
    }

    .stylish-button:hover {
        background-color: #009144;
    }

    .map-container {
        padding: 20px; 
        background-color: #f4f4f4;
        border-radius: 15px; 
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
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

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        overflow: hidden;
        border-radius: 7px;
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

    .filter{
        background-color: #e7e7e7;
        padding: 20px 20px 0 20px;
        border-radius: 5px;
    }
    
    .filter-container {
        margin-bottom: 20px;
    }

    .filter-container select, .filter-container input {
        padding: 8px;
        font-size: 1em;
        margin-right: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .form-row button {
        padding: 8px 15px;
        background-color: #00452C;
        color: white;
        border: none;
        border-radius: 5px;
        height: 50px;
        margin-top: 32px;
    }

    .form-row button:hover {
        background-color: #006633;
    }

    .form-container {
        max-width: 90%;
        margin: auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        font-family: 'Poppins', sans-serif;
        color: #333;
        margin-bottom: 50px; 
    }

    .form-title {
        font-size: 2em;
        font-weight: bold;
        color: #006633;
        text-align: center;
        margin-top: 50px;
        margin-bottom: 100px;
        text-transform: uppercase;
    }

    .form-group {
        margin-bottom: 25px;
        flex: 1 1 45%; /* Mengatur setiap kolom memiliki lebar 45% */
        width: auto;
    }

    select, input[type="text"], input[type="number"], input[type="date"] {
        width: 100%;
        padding: 12px;
        border: 2px solid #ccc;
        border-radius: 6px;
        font-size: 1em;
        transition: border-color 0.3s ease;
    }

    select:focus, input[type="text"]:focus, input[type="number"]:focus, input[type="date"]:focus {
        border-color: #00452C;
        outline: none;
    }

    select::placeholder, input[type="date"], input[type="number"], input[type="text"], input[type="option"]{
        color: #888;
    }

    .submit-button {
        background-color: #006633;
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 6px;
        font-size: 1.1em;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        text-align: center;
    }

    .submit-button:hover {
        background-color: #009144;
        box-shadow: 0 4px 8px rgba(0, 100, 70, 0.3);
    }

    .form-group input[type="checkbox"] {
        margin-right: 5px;
    }

    .form-group input[type="radio"] {
        margin-right: 5px;
    }

    .form-row{
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .table{
        border: #00452C;
        border-radius: 5px;
    }

    .pagination {
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: center;
        padding: 25px;
    }

    #resetFilter{
        /* padding: 8px 15px; */
        background-color: #e7e7e7;
        color: #00452C;
        border-color: #00452C;
        border-style: solid;
        border-radius: 5px;
        border-width: 1.5px;
        height: 50px;
        margin-top: 32px;
    }

    #resetFilter:hover{
        background-color: #006633;
        color: white;
        border-color: #006633;
        border-style: solid;
        border-radius: 5px;
        height: 50px;
        margin-top: 32px;
    }

    label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
        color: #333;
    }

    .infographics {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin: 30px 0;
        margin-top: 10px;
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
        margin-top: 20px;
        margin-bottom: 20px; 
    }

    .maincontainer {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

</style>

<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<div class="content stylish-content">
    <h1 class="page-title">Sebaran Lembaga Penerap SIP di Indonesia </h1>

    <div class="map-container">
        <div class="map">    
            
            <div id="mapindo"></div>

            <div class="anchor-container">
                <a href="{{route('pendampingan_form')}}" class="stylish-button">Isi Data Lembaga Penerap SIP</a>
            </div>
        </div>
    </div>

    <div class="filter">
        <form action="{{ route('pendampingan_main') }}" class="form-row">
            <div class="form-group col-md-5">
                <label for="namaLembaga">Nama Lembaga Penerap</label>
                <input type="text" name="nama_lembaga" id="namaLembaga" placeholder="Masukkan Nama Lembaga Penerap" style="width: 360px">
            </div>
            
            <div class="form-group col-md-5">
                <label for="bsip">BSIP</label>
                <select name="bsip" id="bsip" style="height: 52px">
                    <option value="">Pilih Salah Satu</option>
                    @foreach ($bsip as $bs)
                        <option value="{{ $bs->id }}" {{ request()->bsip == $bs->id ? 'selected' : '' }}>{{ $bs->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group col-md-5">
                <label for="bentukLembaga">Bentuk Lembaga</label>
                <select name="lembaga" id="bentukLembaga" style="height: 52px">
                    <option value="">Pilih Salah Satu</option>
                    @foreach ($lembaga as $lm)
                        <option value="{{ $lm->id }}" {{ request()->lembaga == $lm->id ? 'selected' : '' }}>{{ $lm->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group col-md-5">
                <label for="tahunPendampingan">Tanggal</label>
                {{-- <input type="number" name="tahunPendampingan" class="form-control" id="tahunPendampingan" placeholder="Masukkan Tahun" required> --}}
                <input type="date" name="tanggal" id="tahunPendampingan">
            </div>

            <div class="form-group col-md-5">
                <label for="sipDiterapkan">SIP</label>
                <select name="jenis_standard_id" id="sipDiterapkan" style="height: 52px">
                    <option value="" disabled selected>Pilih Salah Satu</option>
                    @foreach ($jenis_standard as $js)
                        <option value="{{ $js->id }}" {{ request()->jenis_standard_id == $js->id ? 'selected' : '' }}>{{ $js->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit">Filter</button>

            <a href="{{ route('pendampingan_main') }}" id="resetFilter" class="btn btn-secondary d-flex align-items-center" type="button">Reset</a>
        </form>
    </div>
    
    <table id="pendampingan-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lembaga</th>
                <th>BSIP</th>
                <th>Bentuk Lembaga</th>
                <th>Tahun</th>
                <th>SIP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendampingan as $pd)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('pendampingan_detail', Crypt::encryptString($pd->id)) }}" class="link-lembaga">{{ $pd->nama_lembaga }}</a></td>
                    <td>{{ $pd->bsip->name}}</td>
                    <td>{{ $pd->lembaga->name }}</td>
                    <td>{{ substr($pd->tanggal, 0, 4) }}</td>
                    <td>{{ $pd->jenis_standard->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Standar Instrumen Pertanian yang diterapkan</h3>
    <div class="infographics">
        <div class="infographic">
            <h2>Tanaman Pangan (TP)</h2>
            <div class="icon"><i class="fas fa-seedling"></i></div>
            <p>Jumlah SNI: 0</p> 
            <p>Jumlah Lembaga: 5</p> 
        </div>
        <div class="infographic">
            <h2>Hortikultura (Horti)</h2>
            <div class="icon"><i class="fas fa-carrot"></i></div>
            <p>Jumlah SNI: 0</p>
            <p>Jumlah Lembaga: 3</p>
        </div>
        <div class="infographic">
            <h2>Perkebunan (Bun)</h2>
            <div class="icon"><i class="fas fa-apple-alt"></i></div>
            <p>Jumlah SNI: 0</p>
            <p>Jumlah Lembaga: 2</p>
        </div>
        <div class="infographic">
            <h2>Peternakan (Nak)</h2>
            <div class="icon"><i class="fas fa-regular fa-cow"></i></div>
            <p>Jumlah SNI: 0</p>
            <p>Jumlah Lembaga: 4</p>
        </div>
        <div class="infographic">
            <h2>Agroinput</h2>
            <div class="icon"><i class="fa-solid fa-leaf"></i></div>
            <p>Jumlah SNI: 0</p>
            <p>Jumlah Lembaga: 2</p>
        </div>
        <div class="infographic">
            <h2>Pasca Panen (Paspa)</h2>
            <div class="icon"><i class="fas fa-sharp-duotone fa-regular fa-tractor"></i></div>
            <p>Jumlah SNI: 0</p>
            <p>Jumlah Lembaga: 6</p>
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
                { id: 1,'hc-key': 'id-ac', value: 11, name: 'Aceh' },
                { id: 10,'hc-key': 'id-jt', value: 12, name: 'Jawa Tengah' },
                { id: null,'hc-key': 'id-be', value: 13, name: 'Bengkulu' },
                { id: 13,'hc-key': 'id-bt', value: 14, name: 'Banten' },
                { id: 16,'hc-key': 'id-kb', value: 15, name: 'Kalimantan Barat' },
                { id: 8,'hc-key': 'id-bb', value: 16, name: 'Bangka Belitung' },
                { id: null,'hc-key': 'id-ba', value: 17, name: 'Bali' },
                { id: 12,'hc-key': 'id-ji', value: 18, name: 'Jawa Timur' },
                { id: 18,'hc-key': 'id-ks', value: 19, name: 'Kalimantan Selatan' },
                { id: 15,'hc-key': 'id-nt', value: 20, name: 'Nusa Tenggara Timur' },
                { id: 22,'hc-key': 'id-se', value: 21, name: 'Sulawesi Selatan' },
                { id: null,'hc-key': 'id-kr', value: 22, name: 'Kepulauan Riau' },
                { id: 28,'hc-key': 'id-ib', value: 23, name: 'Papua Barat' },
                { id: 2,'hc-key': 'id-su', value: 24, name: 'Sumatera Utara' },
                { id: 4,'hc-key': 'id-ri', value: 25, name: 'Riau' },
                { id: 20,'hc-key': 'id-sw', value: 26, name: 'Sulawesi Utara' },
                { id: null,'hc-key': 'id-ku', value: 27, name: 'Kalimantan Utara' },
                { id: 27,'hc-key': 'id-la', value: 28, name: 'Maluku Utara' },
                { id: 3,'hc-key': 'id-sb', value: 29, name: 'Sumatera Barat' },
                { id: 26,'hc-key': 'id-ma', value: 30, name: 'Maluku' },
                { id: 14,'hc-key': 'id-nb', value: 31, name: 'Nusa Tenggara Barat' },
                { id: 23,'hc-key': 'id-sg', value: 32, name: 'Sulawesi Tenggara' },
                { id: 21,'hc-key': 'id-st', value: 33, name: 'Sulawesi Tengah' },
                { id: 29,'hc-key': 'id-pa', value: 34, name: 'Papua' },
                { id: 9,'hc-key': 'id-jr', value: 35, name: 'Jawa Barat' },
                { id: 19,'hc-key': 'id-ki', value: 36, name: 'Kalimantan Timur' },
                { id: 7,'hc-key': 'id-1024', value: 37, name: 'Lampung' },
                { id: null,'hc-key': 'id-jk', value: 38, name: 'Jakarta' },
                { id: 24,'hc-key': 'id-go', value: 39, name: 'Gorontalo' },
                { id: 11,'hc-key': 'id-yo', value: 40, name: 'Yogyakarta' },
                { id: 6,'hc-key': 'id-sl', value: 41, name: 'Sumatera Selatan' },
                { id: 25,'hc-key': 'id-sr', value: 42, name: 'Sulawesi Barat' },
                { id: 5,'hc-key': 'id-ja', value: 43, name: 'Jambi' },
                { id: 17,'hc-key': 'id-kt', value: 44, name: 'Kalimantan Tengah' }
            ];

            // Create the chart
            Highcharts.mapChart('mapindo', {
                chart: {
                    map: topology
                },

                title: {
                    text: 'Peta Interaktif'
                },

                mapNavigation: {
                    enabled: true,
                    buttonOptions: {
                        verticalAlign: 'bottom'
                    }
                },

                colorAxis: {
                    min: 0,
                    max: 150, // Rentang nilai data
                    stops: [
                        [0, '#95be95'],     // tipis
                        [0.5, '#4c924c'],   // tengah
                        [1, '#006400']      // pekat
                    ]
                    
                },

                series: [{
                    data: data,
                    name: 'Jumlah Lembaga Penerap SIP',
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
                                const route = `/kinerja-kegiatan/pendampingan/tabel-data/${this.id}`;
                                window.location.href = route;  // Redirect ke halaman yang sesuai
                            }
                        }
                    }
                }]
            });

        })();
    </script>
</div>

<!-- Include Leaflet JS -->

@endsection