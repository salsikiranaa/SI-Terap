@extends('layouts.header_navbar_footer_lp2tp')
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
            margin-top: 20px; /* Tambahkan margin-top untuk menurunkan posisi judul */
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .btn-submit {
            background-color: #28a745;
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

        .btn-search {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
        }

        .btn-search:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="container">
        <div class="form-row">
            <!-- Kolom Kiri -->
            <div style="flex: 2;">
                <h2 class="header-title" style="margin-top: 40px;">Judul Penelitian Terkait Komoditas Padi Di Lokus</h2> <!-- Jarak tambahan -->
                <div class="form-group">
                    <label for="kabupaten">Kabupaten</label>
                    <select id="kabupaten" name="kabupaten">
                        <option value="all">All</option>
                        <option value="aceh">Aceh</option>
                        <option value="jakarta">Jakarta</option>
                        <option value="bandung">Bandung</option>
                        <option value="surabaya">Surabaya</option>
                    </select>
                </div>
                <button class="btn-search">Cari</button>
                <div class="form-group">
                    <input type="text" placeholder="Masukan Nama Judul Penelitian Terkait">
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div style="flex: 1;">
                <h2 class="header-title" style="margin-top: 40px;">Riset</h2> <!-- Jarak tambahan -->
                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <select id="provinsi" name="provinsi">
                        <option value="jakarta">DKI Jakarta</option>
                        <option value="jabar">Jawa Barat</option>
                        <option value="jatim">Jawa Timur</option>
                        <option value="bali">Bali</option>
                        <option value="papua">Papua</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kabupaten_kota">Kabupaten/Kota</label>
                    <select id="kabupaten_kota" name="kabupaten_kota">
                        <option value="jakarta">Jakarta Pusat</option>
                        <option value="bandung">Bandung</option>
                        <option value="surabaya">Surabaya</option>
                        <option value="denpasar">Denpasar</option>
                        <option value="jayapura">Jayapura</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <select id="kecamatan" name="kecamatan">
                        <option value="gambir">Gambir</option>
                        <option value="kuta">Kuta</option>
                        <option value="cicadas">Cicadas</option>
                        <option value="wonokromo">Wonokromo</option>
                        <option value="abepura">Abepura</option>
                    </select>
                </div>
                <button class="btn-submit">Kirim</button>
            </div>
        </div>
    </div>
@endsection
