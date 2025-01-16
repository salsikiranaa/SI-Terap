@extends('layouts.layoutPengelolaanUpbs')

@section('content')

<style>
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

    label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
        color: #333;
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

    .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .radio-group {
        display: flex;
        gap: 20px;
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
</style>

<div class="form-container">
    <h2 class="form-title">Form Data Lembaga Penerap Standar Instrumen Pertanian</h2>
    <form action="{{ route('perbenihan.store') }}" method="POST"> 
        @csrf
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="bsip">BSIP</label>
                <select name="bsip_id" id="bsip" style="width: 320px;">
                    <option value="" disabled selected>Pilih Daerah BSIP</option>
                    {{-- @foreach ($bsip as $bs)
                        <option value="{{ $bs->id }}">{{ $bs->name }}</option>
                    @endforeach --}}
                </select>
            </div>

            <div class="form col-md-4">
                <label for="kabupaten_id">Kabupaten</label>
                <select name="kabupaten_id" id="kabupaten_id" required>
                    <option value="" selected disabled>-- Pilih Kabupaten --</option>
                    @foreach ($kabupaten as $kb)
                        <option value="{{ $kb->id }}">{{ $kb->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form col-md-4">
                <label for="kecamatan_id">Kecamatan</label>
                <select name="kecamatan_id" id="kecamatan_id" required>
                    <option value="" selected disabled>-- Pilih kecamatan --</option>
                    @foreach ($kecamatan as $kc)
                        <option value="{{ $kc->id }}">{{ $kc->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form col-md-3.5">
                <label for="desa_id">Desa</label>
                <select name="desa_id" id="desa_id" style="width: 320px;" required>
                    <option value="" selected disabled>-- Pilih desa --</option>
                    {{-- @foreach ($desa as $ds)
                        <option value="{{ $ds->id }}">{{ $ds->name }}</option>
                    @endforeach --}}
                </select>
            </div>

            <div class="form-group col-md-5">
                <label for="namapenerap">Nama</label>
                <input type="text" name="nama_penerap" id="namapenerap" placeholder="Masukkan Nama Penerap" required>
            </div>
            
            <div class="form-group col-md-5">
                <label for="nopenerap">No HP</label>
                <input type="text" name="nopenerap" id="nopenerap" placeholder="Masukkan Nomor HP" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form col-md-3.5">
                <label for="komoditas_id">Komoditas</label>
                <select name="komoditas_id" id="komoditas_id" style="width: 320px;" required>
                    <option value="" selected disabled>-- Pilih Komoditas --</option>
                    @foreach ($komoditas as $km)
                    <option value="{{ $km->id }}">{{ $km->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group col-md-5">
                <label for="kelas_benih_id">Kelas Benih</label>
                <select name="kelas_benih_id" id="kelas_benih_id" required>
                    <option value="" selected disabled>-- Pilih Kelas Benih --</option>
                    @foreach ($kelas_benih as $kb)
                    <option value="{{ $kb->id }}">{{ $kb->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-5">
                <label for="jumlahBenih">Jumlah</label>
                <div class="form-row">
                    <input type="number" name="skala" id="jumlahBenih" placeholder="Jumlah" required>
                    <select name="satuan" id="jumlahBenih" style="" required>
                        <option value="" disabled selected>Satuan</option>
                        <option value="ton">Ton</option>
                        <option value="ha">Hektar (Ha)</option>
                        <option value="unit">Unit</option>
                        <option value="batang">Batang</option>
                    </select>    
                </div>
            </div>    
        </div>
                
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="tanggalpendampingan">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="tanggalpendampingan" style="width: 320px" required>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="submit-button">Kirim Data</button>
        </div>
    </form>
</div>

@endsection