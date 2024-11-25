@extends('layouts.layoutKinerja')

@section('content')
    <style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        margin-bottom: 50px; 
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
        h2 {
            text-align: center;
            color: #009144;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .checkbox-group, .radio-group {
            display: flex;
            flex-wrap: wrap;
        }
        .checkbox-group label, .radio-group label {
            margin-right: 10px;
        }
        .submit-btn {
            background-color: #009144;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            width: 100%;
        }
    </style>

    <div class="form-container">
        <h2>Form Peserta</h2>
        <form action="{{ route('kinerja.diseminasi.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="bpsip">BPSIP</label>
                <select id="bpsip" name="bpsip" class="form-control" required>
                    <option value="" disabled selected>Pilih Wilayah</option>
                    <option value="Aceh">Aceh</option>
                    <option value="Sumatera Utara">Sumatera Utara</option>
                    <option value="Papua">Papua</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
            </div>

            <div class="form-group">
                <label>SIP</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="sip[]" value="TP"> TP</label>
                    <label><input type="checkbox" name="sip[]" value="Horti"> Horti</label>
                    <label><input type="checkbox" name="sip[]" value="Bun"> Bun</label>
                    <label><input type="checkbox" name="sip[]" value="Nak"> Nak</label>
                    <label><input type="checkbox" name="sip[]" value="Agroinput"> Agroinput</label>
                    <label><input type="checkbox" name="sip[]" value="Paspa"> Paspa</label>
                </div>
            </div>

            <div class="form-group">
                <label>Metode</label>
                <div class="radio-group">
                    <label><input type="radio" name="metode" value="Bimbingan Teknis" required> Bimbingan Teknis</label>
                    <label><input type="radio" name="metode" value="Kursus Tani"> Kursus Tani</label>
                    <label><input type="radio" name="metode" value="Focus Group Discussion"> Focus Group Discussion</label>
                    <label><input type="radio" name="metode" value="Sekolah Lapang"> Sekolah Lapang</label>
                </div>
            </div>

            <div class="form-group">
                <label>Sasaran</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="sasaran[]" value="Petani"> Petani</label>
                    <label><input type="checkbox" name="sasaran[]" value="UMKM"> UMKM</label>
                    <label><input type="checkbox" name="sasaran[]" value="Pelaku usaha"> Pelaku usaha</label>
                    <label><input type="checkbox" name="sasaran[]" value="Koperasi"> Koperasi</label>
                    <label><input type="checkbox" name="sasaran[]" value="BUMDes/BUMD"> BUMDes/BUMD</label>
                </div>
            </div>

            <div class="form-group">
                <label for="jumlah_sasaran">Jumlah Sasaran</label>
                <input type="number" id="jumlah_sasaran" name="jumlah_sasaran" class="form-control" placeholder="Masukkan jumlah sasaran" required>
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
@endsection
