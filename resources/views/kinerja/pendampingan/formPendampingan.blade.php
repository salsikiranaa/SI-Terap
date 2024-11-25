@extends('layouts.layoutKinerja')

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
    <h2 class="form-title">Form Data Lembaga Penerap SIP</h2>
    <form action="#" method="POST"> 
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="bsip">BSIP</label>
                <select name="bsip" id="bsip" required>
                    <option value="" disabled selected>Pilih Daerah BSIP</option>
                    <option value="nad">NAD</option>
                    <option value="sumut">Sumatera Utara</option>
                    <option value="sumbar">Sumatera Barat</option>
                </select>
            </div>
            
            <div class="form-group col-md-5">
                <label for="lembagapenerap">Nama Lembaga Penerap</label>
                <input type="text" name="lembagapenerap" id="lembagapenerap" placeholder="Masukkan Nama Lembaga Penerap" required>
            </div>
            
            <div class="form-group col-md-5">
                <label for="alamatpendampingan">Alamat</label>
                <input type="text" name="alamatpendampingan" id="alamatpendampingan" placeholder="Masukkan Alamat lengkap" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="tanggalpendampingan">Tanggal</label>
                <input type="date" name="tanggalpendampingan" class="form-control" id="tanggalpendampingan" required>
            </div>

            <div class="form-group col-md-5">
                <label for="bentukLembaga">Bentuk Lembaga</label>
                <select name="bentukLembaga" id="bentukLembaga" required>
                    <option value="" disabled selected>Pilih Salah Satu</option>
                    <option value="pt">PT</option>
                    <option value="cv">CV</option>
                    <option value="koperasi">Koperasi</option>
                    <option value="kelompok">Kelompok</option>
                    <option value="ud">UD</option>
                    <option value="bumdes">BUMDes</option>
                    <option value="BUMD">BUMD</option>
                </select>
            </div>
            
            <div class="form-group col-md-5">
                <label for="skalaPenerapan">Skala Penerapan</label>
                <div class="form-row">
                    <input type="number" name="noSkalaPenerapan" id="noSkalaPenerapan" placeholder="Isi Nomor Skala" required>
                    <select name="skalaPenerapan" id="skalaPenerapan" required>
                        <option value="" disabled selected>Satuan</option>
                        <option value="ton">Ton</option>
                        <option value="ha">Hektar (Ha)</option>
                        <option value="unit">Unit</option>
                    </select>    
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="lpk">LPK</label>
                <input type="text" name="lpk" id="lpk" placeholder="Masukkan LPK" required>
            </div>

            <div class="form-group col-md-5">
                <label for="standarDitetapkan">Standar yang Ditetapkan</label>
                <select name="standarDitetapkan" id="standarDitetapkan" required>
                    <option value="" disabled selected>Pilih Salah Satu</option>
                    <option value="sni">SNI</option>
                    <option value="GAP">GAP</option>
                    <option value="GHP">GHP</option>
                    <option value="GMP">GMP</option>
                    <option value="PTM">PTM</option>
                </select>
            </div>
    
            <div class="form-group col-md-5">
                <label for="kelompokStandar">Kelompok Standar</label>
                <select name="kelompokStandar" id="kelompokStandar" required>
                    <option value="" disabled selected>Pilih Salah Satu</option>
                    <option value="produk">Produk</option>
                    <option value="sistem">Sistem</option>
                    <option value="proses">Proses</option>
                    <option value="sdm">SDM</option>
                    <option value="jasa">Jasa</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="judulStandar">Judul Standar</label>
                <input type="text" name="judulStandar" id="judulStandar" placeholder="Masukkan Judul Standar" required>
            </div>

            <div class="form-group col-md-5">
                <label for="nostandar">Nomor Tanda Standar</label>
                <input type="number" name="nostandar" id="nostandar" placeholder="Masukkan Nomor Tanda Standar" required>
            </div>

            <div class="form-group col-md-5">
                <label for="capaianKegiatan">Capaian Kegiatan</label>
                <select name="capaianKegiatan" id="capaianKegiatan" required>
                    <option value="" disabled selected>Pilih Salah Satu</option>
                    <option value="belumSertif">Belum Dapat Sertifikat</option>
                    <option value="SertifBinaUmk">Sertifikat Bina UMK</option>
                    <option value="SertifSni">Sertifikat SNI</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="submit-button">Kirim Data</button>
        </div>
    </form>
</div>

@endsection