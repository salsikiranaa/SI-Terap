@extends('layouts.layoutPengelolaanUpbs')
@section('content')

<div class="container">
    <form action="{{ route('perbenihan.store') }}" method="POST">
        @csrf
        <label for="kabupaten_id">Kabupaten</label>
        <select name="kabupaten_id" id="kabupaten_id" required>
            <option value="" selected disabled>-- Pilih Kabupaten --</option>
            @foreach ($kabupaten as $kb)
                <option value="{{ $kb->id }}">{{ $kb->name }}</option>
            @endforeach
        </select>
        <br>
        <label for="komoditas_id">Komoditas</label>
        <select name="komoditas_id" id="komoditas_id" required>
            <option value="" selected disabled>-- Pilih Komoditas --</option>
            @foreach ($komoditas as $km)
                <option value="{{ $km->id }}">{{ $km->name }}</option>
            @endforeach
        </select>
        <br>
        <label for="kelas_benih_id">Kelas Benih</label>
        <select name="kelas_benih_id" id="kelas_benih_id" required>
            <option value="" selected disabled>-- Pilih Kelas Benih --</option>
            @foreach ($kelas_benih as $kb)
                <option value="{{ $kb->id }}">{{ $kb->name }}</option>
            @endforeach
        </select>
        <br>
        <label for="bulan">Bulan</label>
        <select name="bulan" id="bulan" required>
            <option value="" selected disabled>-- Pilih Bulan --</option>
            <option value="Januari">Januari</option>
            <option value="Februari">Februari</option>
            <option value="Maret">Maret</option>
            <option value="April">April</option>
            <option value="Mei">Mei</option>
            <option value="Juni">Juni</option>
            <option value="Juli">Juli</option>
            <option value="Agustus">Agustus</option>
            <option value="September">September</option>
            <option value="Oktober">Oktober</option>
            <option value="November">November</option>
            <option value="Desember">Desember</option>
        </select>
        <br>
        <label for="tahun">Tahun</label>
        <select name="tahun" id="tahun" required>
            <option value="" selected disabled>-- Pilih Tahun --</option>
            @for ($i = now()->year; $i >= 2000; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <br>
        <button type="submit">Submit</button>
    </form>
</div>

@endsection