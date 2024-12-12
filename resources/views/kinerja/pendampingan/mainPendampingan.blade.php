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
        margin: 20px 0;
    }

    .stylish-button {
        display: block;
        width: fit-content;
        margin: 00px auto;
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

</style>

<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div class="content stylish-content">
    <h1 class="page-title">Sebaran Lembaga Penerap SIP di Indonesia </h1>

    <div class="map-container">
        <div class="map">    
            
            <div id="mapindo"></div>

            <a href="{{route('pendampingan_form')}}" class="stylish-button">Isi Data Lembaga Penerap SIP</a>
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
                            const route = `/kinerja-kegiatan/pendampingan/provinsi/${this.id}`;
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