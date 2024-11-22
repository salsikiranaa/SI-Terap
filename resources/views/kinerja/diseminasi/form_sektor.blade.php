@extends('layouts.layoutKinerja')

@section('content')
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4x rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label { 
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #00452c;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .checkbox-group, .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .checkbox-group label, .radio-group label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-weight: normal;
        }
        .form-submit {
            background-color: #00452c;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-submit:hover {
            background-color: #006400;
        }
    </style>

    <div class="form-container">
        <div class="form-group">
            <!-- BBPSIP-->
            <label for="bpsip">BPSIP</label>
            <select id="bpsip" name="bpsip" required>
                <option value="">Pilih BPSIP</option>
                <option value="aceh">Aceh</option>
                <option value="sumut">Sumatera Utara</option>
                <option value="sumbar">Sumatera Barat</option>
                            <option value="riau">Riau</option>
                            <option value="kepri">Kepulauan Riau</option>
                            <option value="jambi">Jambi</option>
                            <option value="sumsel">Sumatera Selatan</option>
                            <option value="bengkulu">Bengkulu</option>
                            <option value="babel">Bangka Belitung</option>
                            <option value="lampung">Lampung</option>
                            <option value="banten">Banten</option>
                            <option value="jakarta">DKI Jakarta</option>
                            <option value="jabar">Jawa Barat</option>
                            <option value="jateng">Jawa Tengah</option>
                            <option value="yogyakarta">Yogyakarta</option>
                            <option value="jatim">Jawa Timur</option>
                            <option value="kalbar">Kalimantan Barat</option>
                            <option value="kalteng">Kalimantan Tengah</option>
                            <option value="kaltim">Kalimantan Timur</option>
                            <option value="kalsel">Kalimantan Selatan</option>
                            <option value="bali">Bali</option>
                            <option value="ntb">Nusa Tenggara Barat</option>
                            <option value="ntt">Nusa Tenggara Timur</option>
                            <option value="sulut">Sulawesi Utara</option>
                            <option value="gorontalo">Gorontalo</option>
                            <option value="sulteng">Sulawesi Tengah</option>
                            <option value="sultra">Sulawesi Tenggara</option>
                            <option value="sulsel">Sulawesi Selatan</option>
                            <option value="sulbar">Sulawesi Barat</option>
                            <option value="malut">Maluku Utara</option>
                            <option value="maluku">Maluku</option>
                            <option value="papbar">Papua Barat</option>
                            <option value="papua">Papua</option>
            </select>
        </div>
        <!--Tanggal-->
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" required>
        </div>
        <!--SIP-->
        <div class="form-group">
            <label for="sip">SIP</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="sip[]" value="tp"> TP</label>
                <label><input type="checkbox" name="sip[]" value="horti"> Horti</label>
                <label><input type="checkbox" name="sip[]" value="bun"> Bun</label>
                <label><input type="checkbox" name="sip[]" value="nak"> Nak</label>
                <label><input type="checkbox" name="sip[]" value="agroinput"> Agroinput</label>
                <label><input type="checkbox" name="sip[]" value="paspa"> Paspa</label>
            </div>
        </div>

        <!--Metode-->
        <div class="form-group">
            <label for="metode">Metode</label>
            <div class="radio-group">
                <label><input type="radio" name="metode" value="bimbingan_teknis" required> Bimbingan Teknis</label>
                <label><input type="radio" name="metode" value="kursus_tani" required> Kursus Tani</label>
                <label><input type="radio" name="metode" value="fgd" required> Focus Group Discussion</label>
                <label><input type="radio" name="metode" value="sekolah_lapang" required> Sekolah Lapang</label>
            </div>
        </div>

        <!-- Sasaran -->
        <div class="form-group">
            <label for="sasaran">Sasaran</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="sasaran[]" value="petani"> Petani</label>
                <label><input type="checkbox" name="sasaran[]" value="umkm"> UMKM</label>
                <label><input type="checkbox" name="sasaran[]" value="pelaku_usaha"> Pelaku Usaha</label>
                <label><input type="checkbox" name="sasaran[]" value="koperasi"> Koperasi</label>
                <label><input type="checkbox" name="sasaran[]" value="bumdes_bumd"> BUMDes/BUMD</label>
            </div>
        </div>

        <!-- Jumlah Sasaran -->
        <div class="form-group">
            <label for="jumlah_sasaran">Jumlah Sasaran</label>
            <input type="number" id="jumlah_sasaran" name="jumlah_sasaran" required>
        </div>

        <!-- Jenis Standar -->
        <div class="form-group">
            <label for="jenis_standar">Jenis Standar</label>
            <select id="jenis_standar" name="jenis_standar" required>
                <option value="">Pilih Jenis Standar</option>
                <option value="sni">SNI</option>
                <option value="gap">GAP</option>
                <option value="ghp">GHP</option>
                <option value="gmp">GMP</option>
                <option value="ptm">PTM</option>
            </select>
        </div>

        <!-- Kelompok Standar -->
        <div class="form-group">
            <label for="kelompok_standar">Kelompok Standar</label>
            <select id="kelompok_standar" name="kelompok_standar" required>
                <option value="">Pilih Kelompok Standar</option>
                <option value="produk">Produk</option>
                <option value="sistem">Sistem</option>
                <option value="proses">Proses</option>
                <option value="sdm">SDM</option>
                <option value="jasa">Jasa</option>
            </select>
        </div>

        <!-- Nomor Standar -->
        <div class="form-group">
            <label for="nomor_standar">Nomor Standar</label>
            <input type="text" id="nomor_standar" name="nomor_standar" required>
        </div>

        <!-- Judul Standar -->
        <div class="form-group">
            <label for="judul_standar">Judul Standar</label>
            <textarea id="judul_standar" name="judul_standar" rows="2" required></textarea>
        </div>

        <!-- Submit -->
        <div class="form-group">
            <button type="submit" class="form-submit">Submit</button>
        </div>
    </form>
</div>
                         
@endsection
