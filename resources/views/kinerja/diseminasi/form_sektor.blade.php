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

    <form action="{{ route('kinerja.diseminasi.store') }}" method="POST" class="form-container">
        @csrf
        <div class="form-group">
            <!-- BBPSIP-->
            <label for="bpsip">BPSIP</label>
            <select id="bpsip" name="bsip_id" required>
                <option value="">-- Pilih BSIP --</option>
                @foreach ($bsip as $b)
                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                @endforeach
            </select>
        </div>
        <!--Tanggal-->
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            {{-- <select name="tahun" id="tahun" required>
                <option value="" selected disabled>-- Pilih Tahun --</option>
                @for ($year = now()->year; $year >= 2000; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select> --}}
            <input type="date" name="tanggal" id="tanggal">
        </div>
        <!--SIP-->
        <div class="form-group">
            <label for="sip">Sub Sektor Standar Instrumen Pertanian</label>
            <div class="checkbox-group">
                @foreach ($sip as $sp)
                <label><input type="checkbox" name="sip_id[]" value="{{ $sp->id }}">{{$sp->name}}</label>
                @endforeach
            </div>
        </div>

        <!--Metode-->
        <div class="form-group">
            <label for="metode">Metode</label>
            <select name="metode_id" id="metode" required>
                <option value="" selected disabled>-- Pilih Metode --</option>
                @foreach ($metode as $mt)
                    <option value="{{ $mt->id }}">{{ $mt->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Sasaran -->
        <div class="form-group">
            <label for="sasaran">Sasaran</label>
            <div class="checkbox-group">
                @foreach ($sasaran as $sr)
                    <label><input type="checkbox" name="sasaran_id[]" value="{{ $sr->id }}">{{ $sr->name }}</label>
                @endforeach
            </div>
        </div>

        <!-- Jumlah Sasaran -->
        <div class="form-group">
            <label for="jumlah_sasaran">Jumlah Sasaran</label>
            <input type="number" min="0" id="jumlah_sasaran" name="jumlah_sasaran" required>
        </div>

        <!-- Jenis Standard -->
        <div class="form-group">
            <label for="jenis_standard">Jenis Standard</label>
            <select id="jenis_standard" name="jenis_standard_id" required>
                <option value="" selected disabled>-- Pilih Jenis Standard --</option>
                @foreach ($jenis_standard as $js)
                    <option value="{{ $js->id }}">{{ $js->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Kelompok Standard -->
        <div class="form-group">
            <label for="kelompok_standard">Kelompok Standard</label>
            <select id="kelompok_standard" name="kelompok_standard_id" required>
                <option value="">-- Pilih Kelompok Standard --</option>
                @foreach ($kelompok_standard as $ks)
                    <option value="{{ $ks->id }}">{{ $ks->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Nomor Standard -->
        <div class="form-group">
            <label for="nomor_standard">Nomor Standard</label>
            <input type="text" id="nomor_standard" name="nomor_standard" required>
        </div>

        <!-- Judul Standard -->
        <div class="form-group">
            <label for="judul_standard">Judul Standard</label>
            <textarea id="judul_standard" name="judul_standard" rows="2" required></textarea>
        </div>

        <!-- Submit -->
        <div class="form-group">
            <button type="submit" class="form-submit">Submit</button>
        </div>
    </form>
</div>

@endsection
