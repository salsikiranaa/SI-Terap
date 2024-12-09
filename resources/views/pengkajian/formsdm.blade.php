@extends('layouts.layoutPengkajian')
@section('content')
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-submit {
            background-color: #28a745; /* Green background */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
        }

        .btn-submit:hover {
            background-color: #218838;
        }
    </style>

    <div class="container">
        <h2 class="header-title">Form Data SDM Penyuluh</h2>

        <form action="/submit-pengkajian" method="POST">
            <div class="form-group">
                <label for="komoditas">Fungsional</label>
                <select id="komoditas" name="komoditas" required>
                    <option value="pertama" selected>Pertama</option>
                    <option value="muda" selected>Muda</option>
                    <option value="madya" selected>Madya</option>
                    <option value="utama" selected>Utama</option>
                </select>
            </div>


            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <select id="provinsi" name="provinsi" required>
                    <option value="jabar" selected>Jawa Barat</option>
                    <option value="jakarta">DKI Jakarta</option>
                    <option value="jatim">Jawa Timur</option>
                    <option value="bali">Bali</option>
                    <option value="papua">Papua</option>
                </select>
            </div>

            <div class="form-group">
                <label for="kabupaten">Kabupaten</label>
                <select id="kabupaten" name="kabupaten" required>
                    <option value="bandung" selected>Bandung</option>
                    <option value="jakarta">Jakarta Pusat</option>
                    <option value="surabaya">Surabaya</option>
                    <option value="denpasar">Denpasar</option>
                    <option value="jayapura">Jayapura</option>
                </select>
            </div>

            <div class="form-group">
                <label for="kecamatan">Kecamatan</label>
                <select id="kecamatan" name="kecamatan" required>
                    <option value="cicadas" selected>Cicadas</option>
                    <option value="gambir">Gambir</option>
                    <option value="kuta">Kuta</option>
                    <option value="wonokromo">Wonokromo</option>
                    <option value="abepura">Abepura</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>
@endsection
