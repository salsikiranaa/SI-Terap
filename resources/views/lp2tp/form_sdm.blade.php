@extends('layouts.header_navbar_footer_lp2tp')
@section('content')
    <style>
        .form-container {
            max-width: 1000px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .form-title {
            font-size: 1.8em;
            font-weight: bold;
            color: #00452C;
            text-align: center;
            margin-bottom: 25px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .form-column {
            flex: 1;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ccc;
            border-radius: 6px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        select:focus, input[type="text"]:focus {
            border-color: #00452C;
            outline: none;
        }

        input[type="text"] {
            font-size: 1.1em;
            line-height: 1.5;
        }

        .submit-button {
            background-color: #00452C;
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
            margin-top: 20px;
        }

        .submit-button:hover {
            background-color: #006a44;
            box-shadow: 0 4px 8px rgba(0, 100, 70, 0.3);
        }
    </style>

    <div class="form-container">
        <h2 class="form-title">Direktori SDM Penyuluh</h2>
        <form action="#" method="POST">
            @csrf
            <div class="form-row">
                <!-- Kolom Kiri -->
                <div class="form-column">
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select name="provinsi" id="provinsi" required>
                            <option value="" disabled selected>Pilih Provinsi</option>
                            <option value="aceh">Aceh</option>
                            <option value="jawa-barat">Jawa Barat</option>
                            <option value="jawa-tengah">Jawa Tengah</option>
                            <option value="kalimantan-timur">Kalimantan Timur</option>
                            <option value="papua">Papua</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kabupaten">Kabupaten/Kota</label>
                        <select name="kabupaten" id="kabupaten" required>
                            <option value="" disabled selected>Pilih Kabupaten/Kota</option>
                            <option value="bandung">Bandung</option>
                            <option value="surabaya">Surabaya</option>
                            <option value="semarang">Semarang</option>
                            <option value="balikpapan">Balikpapan</option>
                            <option value="jayapura">Jayapura</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <select name="kecamatan" id="kecamatan" required>
                            <option value="" disabled selected>Pilih Kecamatan</option>
                            <option value="cimahi">Cimahi</option>
                            <option value="wonosobo">Wonosobo</option>
                            <option value="karanganyar">Karanganyar</option>
                            <option value="samarinda">Samarinda</option>
                            <option value="sentani">Sentani</option>
                        </select>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="form-column">
                    <div class="form-group">
                        <label for="nama_bpp">Nama BPP</label>
                        <input type="text" name="nama_bpp" id="nama_bpp" placeholder="Masukan Nama BPP" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat_bpp">Alamat BPP</label>
                        <input type="text" name="alamat_bpp" id="alamat_bpp" placeholder="Masukan Alamat BPP" required>
                    </div>

                    <div class="form-group">
                        <label for="kontak_bpp">Nomor Kontak BPP</label>
                        <input type="text" name="kontak_bpp" id="kontak_bpp" placeholder="Masukan Nomor Kontak BPP" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-button">Kirim</button>
            </div>
        </form>
    </div>
@endsection
