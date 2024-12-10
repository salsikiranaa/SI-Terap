<?php

namespace App\Http\Controllers\Perbenihan;

use App\Http\Controllers\Controller;
use App\Models\mBSIP;
use App\Models\mKelasBenih;
use App\Models\mKomoditas;
use App\Models\Perbenihan;
use Illuminate\Http\Request;

class PerbenihanController extends Controller
{
    public function index() {
        return view('pengelolaan.berandaPengelolaanUpbs');
    }

    public function provinsi($bsip_id, Request $request) {
        $bsip = mBSIP::find($bsip_id);
        if (!$bsip) return back()->withErrors('BSIP belum terdaftar');
        $komoditas = mKomoditas::get();
        $kelas_benih = mKelasBenih::get();
        $kabupaten = $bsip->provinsi->kabupaten;
        $kabupaten_id = $kabupaten->pluck('id');
        $perbenihan = Perbenihan::whereIn('kabupaten_id', $kabupaten_id);
        if ($request->kabupaten_id) $perbenihan = $perbenihan->where('kabupaten_id', $request->kabupaten_id); 
        if ($request->komoditas_id) $perbenihan = $perbenihan->where('komoditas_id', $request->komoditas_id); 
        if ($request->kelas_benih_id) $perbenihan = $perbenihan->where('kelas_benih_id', $request->kelas_benih_id); 
        if ($request->bulan) $perbenihan = $perbenihan->where('bulan', $request->bulan); 
        if ($request->tahun) $perbenihan = $perbenihan->where('tahun', $request->tahun); 
        $perbenihan = $perbenihan->paginate(10);
        // dd($perbenihan);
        $bulan = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];
        // dd($perbenihan);
        return view('pengelolaan.tabelBenih', [
            'perbenihan' => $perbenihan,
            'bsip' => $bsip,
            'kabupaten' => $kabupaten,
            'komoditas' => $komoditas,
            'kelas_benih' => $kelas_benih,
            'bulan' => $bulan,
        ]);
    }
}
