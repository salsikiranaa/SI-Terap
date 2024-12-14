<?php

namespace App\Http\Controllers\Kinerja;

use App\Http\Controllers\Controller;
use App\Models\mBSIP;
use App\Models\mJenisStandard;
use App\Models\mKelompokStandard;
use App\Models\mLembaga;
use App\Models\Pendampingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PendampinganController extends Controller
{
    public function index() {
        return view('kinerja.pendampingan.mainPendampingan');
    }

    public function show($bsip_id, Request $request) {
        $bsip = mBSIP::find($bsip_id);
        if (!$bsip) return back()->withErrors('BSIP belum terdaftar');
        $pendampingan = Pendampingan::where('bsip_id', $bsip_id);
        if ($request->nama_lembaga) $pendampingan = $pendampingan->where('nama_lembaga', 'LIKE', "%$request->nama_lembaga%");
        if ($request->lembaga_id) $pendampingan = $pendampingan->where('lembaga_id', $request->lembaga_id);
        if ($request->tahun) $pendampingan = $pendampingan->where('tanggal', 'LIKE', "$request->tahun%");
        if ($request->jenis_standard_id) $pendampingan = $pendampingan->where('jenis_standard_id', $request->jenis_standard_id);
        $pendampingan = $pendampingan->paginate(10);

        $lembaga = mLembaga::select(['id', 'name'])->get();
        $jenis_standard = mJenisStandard::select(['id', 'name'])->get();
        return view('kinerja.pendampingan.tabelPendampingan', [
            'bsip' => $bsip,
            'pendampingan' => $pendampingan,
            'lembaga' => $lembaga,
            'jenis_standard' => $jenis_standard,
        ]);
    }

    public function detail($id) {
        $pendampingan = Pendampingan::find(Crypt::decryptString($id));
        if (!$pendampingan) return back()->withErrors('data not found');
        return view('kinerja.pendampingan.detailDataPendampingan', [
            'pendampingan' => $pendampingan,
        ]);
    }

    public function create() {
        $bsip = mBSIP::select(['id', 'name'])->get();
        $lembaga = mLembaga::select(['id', 'name'])->get();
        $jenis_standard = mJenisStandard::select(['id', 'name'])->get();
        $kelompok_standard = mKelompokStandard::select(['id', 'name'])->get();
        return view('kinerja.pendampingan.formPendampingan', [
            'bsip' => $bsip,
            'lembaga' => $lembaga,
            'jenis_standard' => $jenis_standard,
            'kelompok_standard' => $kelompok_standard,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'bsip_id' => 'required',
            'tanggal' => 'required|date',
            'nama_lembaga' => 'required|string',
            'lembaga_id' => 'required',
            'alamat' => 'required|string',
            'skala' => 'required|integer',
            'unit_skala' => 'required|in:ton,ha,unit', // enum ['ton', 'ha', 'unit']
            'lpk' => 'required|string',
            'jenis_standard_id' => 'required',
            'kelompok_standard_id' => 'required',
            'nomor_standard' => 'required|string',
            'judul_standard' => 'required|string',
            'capaian_kegiatan' => 'required|in:belum dapat sertifikat,sertifikat bina UMKM,sertifikat SNI',
        ], [
            'bsip_id.required' => 'BSIP cannot be null',
            'tanggal.required' => 'Tanggal cannot be null',
            'tanggal.date' => 'Tanggal must be a date',
            'nama_lembaga.required' => 'Nama Lembaga cannot be null',
            'nama_lembaga.string' => 'Nama Lembaga must be a string',
            'lembaga_id.required' => 'Lembaga cannot be null',
            'alamat.required' => 'Alamat cannot be null',
            'alamat.string' => 'Alamat must be a string',
            'skala.required' => 'Skala cannot be null',
            'skala.integer' => 'Skala must be an integer',
            'unit_skala.required' => 'Unit Skala cannot be null',
            'unit_skala.in' => 'Unit Skala must be one of the following: ton, ha, unit',
            'lpk.required' => 'LPK cannot be null',
            'lpk.string' => 'LPK must be a string',
            'jenis_standard_id.required' => 'Jenis Standard cannot be null',
            'kelompok_standard_id.required' => 'Kelompok Standard cannot be null',
            'nomor_standard.required' => 'Nomor Standard cannot be null',
            'nomor_standard.string' => 'Nomor Standard must be a string',
            'judul_standard.required' => 'Judul Standard cannot be null',
            'judul_standard.string' => 'Judul Standard must be a string',
            'capaian_kegiatan.required' => 'Capaian Kegiatan cannot be null',
            'capaian_kegiatan.in' => 'Capaian Kegiatan must be one of the following: belum dapat sertifikat, sertifikat bina UMKM, sertifikat SNI',
        ]);
        $data_pendampingan = [
            'bsip_id' => $request->bsip_id,
            'tanggal' => $request->tanggal,
            'nama_lembaga' => $request->nama_lembaga,
            'lembaga_id' => $request->lembaga_id,
            'alamat' => $request->alamat,
            'skala' => $request->skala,
            'unit_skala' => $request->unit_skala,
            'lpk' => $request->lpk,
            'jenis_standard_id' => $request->jenis_standard_id,
            'kelompok_standard_id' => $request->kelompok_standard_id,
            'nomor_standard' => $request->nomor_standard,
            'judul_standard' => $request->judul_standard,
            'capaian_kegiatan' => $request->capaian_kegiatan,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ];
        Pendampingan::create($data_pendampingan);
        // return back()->with('success', 'created');
        return redirect()->route('pendampingan_main')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $pendampingan = Pendampingan::find(Crypt::decryptString($id));
        if (!$pendampingan) return back()->withErrors('data not found');
        $request->validate([
            'bsip_id' => 'required',
            'tanggal' => 'required|date',
            'nama_lembaga' => 'required|string',
            'lembaga_id' => 'required',
            'alamat' => 'required|string',
            'skala' => 'required|integer',
            'unit_skala' => 'required|in:ton,ha,unit', // enum ['ton', 'ha', 'unit']
            'lpk' => 'required|string',
            'jenis_standard_id' => 'required',
            'kelompok_standard_id' => 'required',
            'nomor_standard' => 'required|string',
            'judul_standard' => 'required|string',
            'capaian_kegiatan' => 'required|in:belum dapat sertifikat,sertifikat bina UMKM,sertifikat SNI',
        ], [
            'bsip_id.required' => 'BSIP cannot be null',
            'tanggal.required' => 'Tanggal cannot be null',
            'tanggal.date' => 'Tanggal must be a date',
            'nama_lembaga.required' => 'Nama Lembaga cannot be null',
            'nama_lembaga.string' => 'Nama Lembaga must be a string',
            'lembaga_id.required' => 'Lembaga cannot be null',
            'alamat.required' => 'Alamat cannot be null',
            'alamat.string' => 'Alamat must be a string',
            'skala.required' => 'Skala cannot be null',
            'skala.integer' => 'Skala must be an integer',
            'unit_skala.required' => 'Unit Skala cannot be null',
            'unit_skala.in' => 'Unit Skala must be one of the following: ton, ha, unit',
            'lpk.required' => 'LPK cannot be null',
            'lpk.string' => 'LPK must be a string',
            'jenis_standard_id.required' => 'Jenis Standard cannot be null',
            'kelompok_standard_id.required' => 'Kelompok Standard cannot be null',
            'nomor_standard.required' => 'Nomor Standard cannot be null',
            'nomor_standard.string' => 'Nomor Standard must be a string',
            'judul_standard.required' => 'Judul Standard cannot be null',
            'judul_standard.string' => 'Judul Standard must be a string',
            'capaian_kegiatan.required' => 'Capaian Kegiatan cannot be null',
            'capaian_kegiatan.in' => 'Capaian Kegiatan must be one of the following: belum dapat sertifikat, sertifikat bina UMKM, sertifikat SNI',
        ]);
        $data_pendampingan = [
            'bsip_id' => $request->bsip_id,
            'tanggal' => $request->tanggal,
            'nama_lembaga' => $request->nama_lembaga,
            'lembaga_id' => $request->lembaga_id,
            'alamat' => $request->alamat,
            'skala' => $request->skala,
            'unit_skala' => $request->unit_skala,
            'lpk' => $request->lpk,
            'jenis_standard_id' => $request->jenis_standard_id,
            'kelompok_standard_id' => $request->kelompok_standard_id,
            'nomor_standard' => $request->nomor_standard,
            'judul_standard' => $request->judul_standard,
            'capaian_kegiatan' => $request->capaian_kegiatan,
            'updated_by' => Auth::user()->id,
        ];
        $pendampingan->update($data_pendampingan);
        // return back()->with('success', 'updated');
        return redirect()->route('pendampingan_main')->with('success', 'updated');
    }
    
    public function destroy($id) {
        $pendampingan = Pendampingan::find(Crypt::decryptString($id));
        if (!$pendampingan) return back()->withErrors('data not found');
        $pendampingan->delete();
        // return back()->with('success', 'deleted');
        return redirect()->route('pendampingan_main')->with('success', 'deleted');
    }
}
