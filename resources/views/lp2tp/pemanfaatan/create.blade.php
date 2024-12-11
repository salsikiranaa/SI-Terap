@extends('layouts.layoutIp2tp')

@section('content')
<style>
    #input_pemanfaatan_bangunan,
    #input_pemanfaatan_diseminasi {
        width: fit-content;
        padding: 5px 10px;
        margin-bottom: 5px;
        display: flex;
        flex-direction: column;
        gap: 5px;
        border: 1px solid black;
    }
    #input_pemanfaatan_bangunan > div,
    #input_pemanfaatan_diseminasi > div {
        display: flex;
        align-items: center;
        gap: 5px;
    }
</style>

<div class="container">
    <h1>BUATKAN FE NYA</h1>
    <form action="{{ route('lp2tp.pemanfaatan_kp.store') }}" method="POST">
        @csrf
        <label for="ip2sip_id">
            IP2SIP <br>
            <select name="ip2sip_id" id="ip2sip_id" required>
                <option value="" disabled selected>--options--</option>
                @foreach($ip2sip as $ip)
                    <option value="{{ $ip->id }}">BSIP {{ $ip->bsip->name }} -- IP2SIP {{ $ip->name }}</option>
                @endforeach
            </select>
        </label><br>
        <label for="luas_sip">
            Luas SIP <br>
            <input type="number" min="0" step="0.001" name="luas_sip" id="luas_sip" required>&ensp;Ha
        </label><br>
        <label for="jumlah_sdm">
            Jumlah SDM <br>
            <input type="number" min="0" name="jumlah_sdm" id="jumlah_sdm" required>&ensp;Orang
        </label><br>
        <label for="agro_ekosistem">
            Agro Ekosistem <br>
            <input type="text" name="agro_ekosistem" id="agro_ekosistem" required>
        </label><br>
        <label for="nomor_sertifikat">
            Nomor Sertifikat <br>
            <input type="text" name="nomor_sertifikat" id="nomor_sertifikat" required>
        </label><br>
        <label for="pj_sertifikat">
            Penanggung Jawab Sertifikat <br>
            <input type="text" name="pj_sertifikat" id="pj_sertifikat" required>
        </label><br>
        <div>
            Pemanfaatan Bangunan <br>
        </div>
        <div id="input_bangunan_container">
            <div id="input_pemanfaatan_bangunan">
                1.
                <div>
                    Nama 
                    <input type="text" name="pemanfaatan_bangunan[0][name]" id="pemanfaatan_bangunan_name" required>
                </div>
                <div>
                    Luas
                    <input type="number" min="0" step="0.001" name="pemanfaatan_bangunan[0][luas]" id="pemanfaatan_bangunan_luas" required>Ha
                </div>
            </div>
            <button type="button" onclick="addInputBangunan()" id="add_bangunan">+</button>
        </div>
        <div>
            Pemanfaatan Diseminasi <br>
        </div>
        <div id="input_diseminasi_container">
            <div id="input_pemanfaatan_diseminasi">
                1.
                <div>
                    Nama 
                    <input type="text" name="pemanfaatan_diseminasi[0][name]" id="pemanfaatan_diseminasi_name" required>
                </div>
                <div>
                    Luas
                    <input type="number" min="0" step="0.001" name="pemanfaatan_diseminasi[0][luas]" id="pemanfaatan_diseminasi_luas" required>Ha
                </div>
            </div>
            <button type="button" onclick="addInputDiseminasi()" id="add_diseminasi">+</button>
        </div>
        
        <br>
        <button type="submit">Submit</button>
    </form>
</div>

<script>
    let currentIndexBangunan = 0
    let currentIndexDiseminasi = 0
    const addInputBangunan = () => {
        const container = document.getElementById('input_bangunan_container')
        const addButton = document.getElementById('add_bangunan')
        const newInput = document.createElement('div')
        currentIndexBangunan++
        newInput.id = 'input_pemanfaatan_bangunan'
        newInput.innerHTML = `
            ${currentIndexBangunan+1}.
            <div>
                Nama 
                <input type="text" name="pemanfaatan_bangunan[${currentIndexBangunan}][name]" id="pemanfaatan_bangunan_name" required>
            </div>
            <div>
                Luas
                <input type="number" min="0" step="0.001" name="pemanfaatan_bangunan[${currentIndexBangunan}][luas]" id="pemanfaatan_bangunan_luas" required>Ha
            </div>
        `
        container.insertBefore(newInput, addButton)
    }
    const addInputDiseminasi = () => {
        const container = document.getElementById('input_diseminasi_container')
        const addButton = document.getElementById('add_diseminasi')
        const newInput = document.createElement('div')
        currentIndexDiseminasi++
        newInput.id = 'input_pemanfaatan_diseminasi'
        newInput.innerHTML = `
            ${currentIndexDiseminasi+1}.
            <div>
                Nama 
                <input type="text" name="pemanfaatan_diseminasi[${currentIndexDiseminasi}][name]" id="pemanfaatan_diseminasi_name" required>
            </div>
            <div>
                Luas
                <input type="number" min="0" step="0.001" name="pemanfaatan_diseminasi[${currentIndexDiseminasi}][luas]" id="pemanfaatan_diseminasi_luas" required>Ha
            </div>
        `
        container.insertBefore(newInput, addButton)
    }
</script>
@endsection