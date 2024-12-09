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
            margin-bottom: 10px;
            width: 100%;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-row .form-group {
            flex: 1;
            min-width: 180px;
        }

        .btn-container {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 15px;
        }

        .btn-search,
        .btn-isi-form {
            background-color: #28a745;  /* Green background */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
        }

        .btn-search:hover,
        .btn-isi-form:hover {
            background-color: #218838;  /* Darker green on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
    </style>

    <div class="container">
        <h2 class="header-title">Pengkajian Spesifik Lokasi</h2>

        <!-- Filter Section -->
        <div class="form-row">
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal">
            </div>
            <div class="form-group">
                <label for="komoditas">Komoditas</label>
                <select id="komoditas" name="komoditas">
                    <option value="all">All</option>
                    <option value="tp">Tanaman Pangan (TP)</option>
                    <option value="horti">Hortikultura (Horti)</option>
                    <option value="bun">Buah-Buahan (Bun)</option>
                    <option value="nak">Peternakan (Nak)</option>
                    <option value="agroinput">Agroinput</option>
                    <option value="paspa">Pasar Pertanian (Paspa)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select id="tahun" name="tahun">
                    <option value="all">All</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <select id="provinsi" name="provinsi">
                    <option value="all">All</option>
                    <option value="jakarta">DKI Jakarta</option>
                    <option value="jabar">Jawa Barat</option>
                    <option value="jatim">Jawa Timur</option>
                    <option value="bali">Bali</option>
                    <option value="papua">Papua</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kabupaten">Kabupaten</label>
                <select id="kabupaten" name="kabupaten">
                    <option value="all">All</option>
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
                    <option value="all">All</option>
                    <option value="gambir">Gambir</option>
                    <option value="kuta">Kuta</option>
                    <option value="cicadas">Cicadas</option>
                    <option value="wonokromo">Wonokromo</option>
                    <option value="abepura">Abepura</option>
                </select>
            </div>
        </div>

        <!-- Buttons Container -->
        <div class="btn-container">
            <button class="btn-search">Cari</button>
            <a href="{{ route('formriset') }}" class="btn-search">Isi Form</a>
        </div>

        <!-- Table Section -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Pengkajian Spesifik Lokasi</th>
                    <th>Komoditas</th>
                    <th>Tahun</th>
                    <th>Provinsi</th>
                    <th>Kabupaten</th>
                    <th>Kecamatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Implementasi Pertanian</td>
                    <td>Tanaman Pangan (TP)</td>
                    <td>2023</td>
                    <td>Jawa Barat</td>
                    <td>Bandung</td>
                    <td>Cicadas</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Implementasi Pertanian</td>
                    <td>Hortikultura (Horti)</td>
                    <td>2023</td>
                    <td>Jawa Timur</td>
                    <td>Surabaya</td>
                    <td>Wonokromo</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Implementasi Pertanian</td>
                    <td>Buah-Buahan (Bun)</td>
                    <td>2024</td>
                    <td>Bali</td>
                    <td>Denpasar</td>
                    <td>Kuta</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Implementasi Pertanian</td>
                    <td>Peternakan (Nak)</td>
                    <td>2024</td>
                    <td>Papua</td>
                    <td>Jayapura</td>
                    <td>Abepura</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Implementasi Pertanian</td>
                    <td>Agroinput</td>
                    <td>2023</td>
                    <td>DKI Jakarta</td>
                    <td>Jakarta Pusat</td>
                    <td>Gambir</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Implementasi Pertanian</td>
                    <td>Pasar Pertanian (Paspa)</td>
                    <td>2024</td>
                    <td>Jawa Barat</td>
                    <td>Bandung</td>
                    <td>Cicadas</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
