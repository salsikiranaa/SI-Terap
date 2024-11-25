@extends('layouts.layoutKinerja')

@section('content')
    
<style>
    .detail-container {
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

    .detail-title {
        font-size: 2em;
        font-weight: bold;
        color: #006633;
        text-align: center;
        margin-top: 50px;
        margin-bottom: 100px;
        text-transform: uppercase;
    }

    .detail-group {
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
        /* font-weight: bold; */
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        text-align: center;
        text-decoration: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .submit-button:hover {
        background-color: #009144;
        box-shadow: 0 4px 8px rgba(0, 100, 70, 0.3);
    }

    .detail-group input[type="checkbox"] {
        margin-right: 5px;
    }

    .detail-group input[type="radio"] {
        margin-right: 5px;
    }

    .detail-row{
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    p{
        text-align: justify;
    }
</style>

<div class="detail-container">
    <h2 class="detail-title">Detail Data Lembaga Penerap SIP</h2>
    <detail> 
        <div class="detail-row">
            <div class="detail-group col-md-5">
                <label for="bsip">BSIP</label>
                <p>BSIP Nanggroe Aceh Darussalam</p>
            </div>
            
            <div class="detail-group col-md-5">
                <label for="lembagapenerap">Nama Lembaga Penerap</label>
                <p>PT Perkebunan Indonesia</p>
            </div>

            <div class="detail-group col-md-5">
                <label for="alamat">Alamat</label>
                <p>Jl. Tentara Pelajar No.10, RT.01/RW.07, Ciwaringin, Kecamatan Kuta Alam, Kota Banda Aceh, Nanggroe Aceh Darussalam 23126</p>
            </div>
        </div>

        <div class="detail-row">
            <div class="detail-group col-md-5">
                <label for="tanggalpendampingan">Tanggal</label>
                <p>23 November 2024</p>
            </div>

            <div class="detail-group col-md-5">
                <label for="bentukLembaga">Bentuk Lembaga</label>
                <p>PT</p>
            </div>

            <div class="detail-group col-md-5">
                <label for="skalaPenerapan">Skala Penerapan</label>
                <p>150 Hektar (ha)</p>
            </div>
        </div>

        <div class="detail-row">
            <div class="detail-group col-md-5">
                <label for="lpk">LPK</label>
                <p>123svipb890</p>
            </div>

            <div class="detail-group col-md-5">
                <label for="standarDitetapkan">Standar yang Ditetapkan</label>
                <p>SNI</p>
            </div>
    
            <div class="detail-group col-md-5">
                <label for="kelompokStandar">Kelompok Standar</label>
                <p>Produk</p>
            </div>
        </div>

        <div class="detail-row">
            <div class="detail-group col-md-5">
                <label for="judulStandar">Judul Standar</label>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
            </div>

            <div class="detail-group col-md-5">
                <label for="nostandar">Nomor Tanda Standar</label>
                <p>123456789</p>
            </div>

            <div class="detail-group col-md-5">
                <label for="capaianKegiatan">Capaian Kegiatan</label>
                <p>Sertifikat SNI</p>
            </div>
        </div>

        <div class="detail-group">
            <a href="{{ route('pendampingan_tabel') }}" class="submit-button">Kembali</a>
        </div>
    </form>
</div>

@endsection