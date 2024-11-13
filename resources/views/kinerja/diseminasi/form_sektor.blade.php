@extends('layouts.header_navbar_footer')

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
        h1 {
            text-align: center;
            color: #009144;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #009144;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: 100%;
        }
        button:hover {
            background-color: #007b36;
        }
    </style>

    <div class="form-container">
        <h1>Isi Form SIP yang Didiseminasikan</h1>
        <form action="{{ route('diseminasi.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="jenis_standar">Jenis Standar:</label>
                <select name="jenis_standar" id="jenis_standar" required>
                    <option value="">-- Pilih Salah Satu --</option>
                    <option value="SNI">SNI</option>
                    <option value="GAP">GAP</option>
                    <option value="GHP">GHP</option>
                    <option value="GMP">GMP</option>
                    <option value="PTM">PTM</option>
                </select>
            </div>

            <div class="form-group">
                <label for="kelompok_standar">Kelompok Standar:</label>
                <select name="kelompok_standar" id="kelompok_standar" required>
                    <option value="">-- Pilih Salah Satu --</option>
                    <option value="Produk">Produk</option>
                    <option value="Sistem">Sistem</option>
                    <option value="Proses">Proses</option>
                    <option value="SDM">SDM</option>
                    <option value="Jasa">Jasa</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nomor_standar">Nomor Standar:</label>
                <input type="text" name="nomor_standar" id="nomor_standar" required>
            </div>

            <div class="form-group">
                <label for="judul_standar">Judul Standar:</label>
                <input type="text" name="judul_standar" id="judul_standar" required>
            </div>

            <button type="submit">Kirim</button>
        </form>
    </div>
@endsection
