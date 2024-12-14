<?php

namespace App\Http\Controllers\Perbenihan;

use App\Http\Controllers\Controller;
use App\Models\mBSIP;
use App\Models\mKelasBenih;
use App\Models\mKomoditas;
use App\Models\Perbenihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

    public function create() {
        return '<h1>BUATKAN FRONTEND NYA !!!</h1>';
    }

    public function store(Request $request) {
        $request->validate([
            'kabupaten_id' => 'required|integer',
            'komoditas_id' => 'required|integer',
            'kelas_benih_id' => 'required|integer',
            'bulan' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun' => 'required|year'
        ], [
            'kabupaten_id.required' => 'Kabupaten tidak boleh kosong',
            'kabupaten_id.integer' => 'Kabupaten harus berupa angka',
            'komoditas_id.required' => 'Komoditas tidak boleh kosong',
            'komoditas_id.integer' => 'Komoditas harus berupa angka',
            'kelas_benih_id.required' => 'Kelas Benih tidak boleh kosong',
            'kelas_benih_id.integer' => 'Kelas Benih harus berupa angka',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'bulan.in' => 'Bulan tidak valid',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'tahun.year' => 'Tahun harus berupa angka',
        ]);
        $perbenihan = Perbenihan::create([
            'kabupaten_id' => $request->kabupaten_id,
            'komoditas_id' => $request->komoditas_id,
            'kelas_benih_id' => $request->kelas_benih_id,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);
        if (!$perbenihan) return back()->withErrors('gagal menyimpan')->withInput();
        return redirect()->route('perbenihan.index')->with('success', 'Data berhasil disimpan');
    }

    // public function edit($id) {
    //     $perbenihan = Perbenihan::find(Crypt::decryptString($id));
    //     if (!$perbenihan) return back()->withErrors('Data tidak ditemukan');
    //     return view('perbenihan edit form view path');
    // }

    public function update($id, Request $request) {
        $perbenihan = Perbenihan::find(Crypt::decryptString($id));
        if (!$perbenihan) return back()->withErrors('Data tidak ditemukan');
        $request->validate([
            'kabupaten_id' => 'required|integer',
            'komoditas_id' => 'required|integer',
            'kelas_benih_id' => 'required|integer',
            'bulan' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun' => 'required|year'
        ], [
            'kabupaten_id.required' => 'Kabupaten tidak boleh kosong',
            'kabupaten_id.integer' => 'Kabupaten harus berupa angka',
            'komoditas_id.required' => 'Komoditas tidak boleh kosong',
            'komoditas_id.integer' => 'Komoditas harus berupa angka',
            'kelas_benih_id.required' => 'Kelas Benih tidak boleh kosong',
            'kelas_benih_id.integer' => 'Kelas Benih harus berupa angka',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'bulan.in' => 'Bulan tidak valid',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'tahun.year' => 'Tahun harus berupa angka',
        ]);
        $perbenihan = $perbenihan->update([
            'kabupaten_id' => $request->kabupaten_id,
            'komoditas_id' => $request->komoditas_id,
            'kelas_benih_id' => $request->kelas_benih_id,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);
        if (!$perbenihan) return back()->withErrors('gagal menyimpan')->withInput();
        return redirect()->route('perbenihan.index')->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id) {
        $perbenihan = Perbenihan::find(Crypt::decryptString($id));
        if (!$perbenihan) return back()->withErrors('Data tidak ditemukan');
        $perbenihan->delete();
        return redirect()->route('perbenihan.index')->with('success', 'Data berhasil dihapus');
    }
}
