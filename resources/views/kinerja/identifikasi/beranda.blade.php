@extends('layouts.layoutKinerja')

@section('content')
<style>
    .content.stylish-content {
        padding: 20px;
    }

    .page-title {
        text-align: center;
        font-size: 2em;
        color: #00452C;
        margin: 10px 0; /* Mengurangi jarak vertikal */
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
    }

    .map-container {
        padding: 20px; 
        background-color: #ffff;
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

    <div class="content stylish-content">
        <h1 class="page-title">Peta Sebaran Identifikasi dan Inventarisasi SIP </h1>    
        <div class="map-container">
        <div class="map">      
            <div id="mapindo"></div>
            <a href="{{route('form_sip')}}" class="stylish-button">Isi Data SIP</a>
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
                            const route = `/identifikasi/provinsi/${this['hc-key']}`;
                            window.location.href = route;  // Redirect ke halaman yang sesuai
                        }
                    }
                }
            }]
        });

        })();
    </script>

</div>
@endsection
