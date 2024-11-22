@extends('layouts.header_navbar_footer_lab')
@section('content')
    <style>
        .form-container {
            max-width: 800px;
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
            color: #00452C;
            text-align: center;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        .form-section-title {
            font-size: 1.5em;
            font-weight: bold;
            color: #00452C;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        select, input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ccc;
            border-radius: 6px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        select:focus, input[type="text"]:focus, input[type="number"]:focus, textarea:focus {
            border-color: #00452C;
            outline: none;
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
        }

        .submit-button:hover {
            background-color: #006a44;
            box-shadow: 0 4px 8px rgba(0, 100, 70, 0.3);
        }
    </style>

    <div class="form-container">
        <h2 class="form-title">Form Data Laboratorium</h2>
        <form action="#" method="POST">
            <!-- Bagian Nama BPSIP -->
            <div class="form-group">
                <label for="nama_bpsip">Nama BPSIP</label>
                <input type="text" name="nama_bpsip" id="nama_bpsip" placeholder="Masukkan nama BPSIP" required>
            </div>

            <!-- Bagian Jenis Laboratorium -->
            <div class="form-group">
                <label for="jenis_lab">Jenis Laboratorium</label>
                <input type="text" name="jenis_lab" id="jenis_lab" placeholder="Masukkan jenis laboratorium" required>
            </div>

            <!-- Ruang Lingkup Analisis -->
            <div class="form-section-title">Ruang Lingkup Analisis</div>
            <div class="form-group">
                <label for="jenis_analisis">Jenis Analisis</label>
                <textarea name="jenis_analisis" id="jenis_analisis" rows="3" placeholder="Masukkan jenis analisis yang dilakukan" required></textarea>
            </div>
            <div class="form-group">
                <label for="metode_analisis">Metode Analisis</label>
                <textarea name="metode_analisis" id="metode_analisis" rows="3" placeholder="Masukkan metode analisis" required></textarea>
            </div>

            <!-- Dukungan SDM Laboratorium -->
            <div class="form-section-title">Dukungan SDM Laboratorium</div>
            <div class="form-group">
                <label for="analisis">Analisis</label>
                <textarea name="analisis" id="analisis" rows="3" placeholder="Masukkan analisis yang dilakukan" required></textarea>
            </div>
            <div class="form-group">
                <label for="kompetensi_personal">Kompetensi Personal</label>
                <textarea name="kompetensi_personal" id="kompetensi_personal" rows="2" placeholder="Masukkan informasi kompetensi personal" required></textarea>
            </div>

            <!-- Pelatihan -->
            <div class="form-section-title">Pelatihan</div>
            <div class="form-group">
                <label for="pelatihan">Nama Pelatihan</label>
                <textarea name="pelatihan" id="pelatihan" rows="3" placeholder="Masukkan nama dan jenis pelatihan" required></textarea>
            </div>
            <div class="form-group">
                <label for="waktu">Waktu</label>
                <select name="waktu" id="waktu" required>
                    <option value="" disabled selected>Pilih Tahun</option>
                    @for ($year = now()->year; $year >= 2000; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>

            <!-- Tombol Submit -->
            <div class="form-group">
                <button type="submit" class="submit-button">Kirim Data</button>
            </div>
        </form>
    </div>
@endsection
