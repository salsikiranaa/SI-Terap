<?php

namespace App\Http\Controllers\Kinerja;

use App\Http\Controllers\Controller;
use App\Models\Diseminasi;
use App\Models\mBSIP;
use App\Models\mJenisStandard;
use App\Models\mKelompokStandard;
use App\Models\mMetode;
use App\Models\mSasaran;
use App\Models\mSIP;
use App\Models\pDiseminasiSasaran;
use App\Models\pDiseminasiSIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DiseminasiController extends Controller
{
    public function index(Request $request) {
        $diseminasi = new Diseminasi();

        if ($request->bsip_id) $diseminasi = $diseminasi->where('bsip_id', $request->bsip_id);
        if ($request->tanggal) $diseminasi = $diseminasi->where('tanggal', 'LIKE', "%$request->tanggal%");
        if ($request->sip_id) $diseminasi = $diseminasi->whereHas('sip', function ($query) use ($request) {
            $query->where('sip_id', $request->sip_id);
        });
        if ($request->jenis_standard_id) $diseminasi = $diseminasi->where('jenis_standard_id', $request->jenis_standard_id);

        $diseminasi = $diseminasi->get();

        $jumlah_sasaran = Diseminasi::sum('jumlah_sasaran');
        $bsip = mBSIP::whereHas('diseminasi')->get();
        $sip = mSIP::get();
        $jenis_standard = mJenisStandard::get();
        foreach ($bsip as $b) {
            $b->provinsi = $b->provinsi;
        }
        return view('kinerja.diseminasi.beranda', [
            'diseminasi' => $diseminasi,
            'jumlah_sasaran' => $jumlah_sasaran,
            'bsip' => $bsip,
            'sip' => $sip,
            'jenis_standard' => $jenis_standard,
        ]);
    }

    public function create(Request $request) {
        $bsip = mBSIP::get();
        $metode = mMetode::get();
        $sip = mSIP::get();
        $sasaran = mSasaran::get();
        $jenis_standard = mJenisStandard::get();
        $kelompok_standard = mKelompokStandard::get();
        return view('kinerja.diseminasi.form_sektor', [
            'bsip' => $bsip,
            'metode' => $metode,
            'sip' => $sip,
            'sasaran' => $sasaran,
            'jenis_standard' => $jenis_standard,
            'kelompok_standard' => $kelompok_standard,
        ]);
    }

    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'bsip_id' => 'required',
            'tanggal' => 'required|date',
            'metode_id' =>  'required',
            'jumlah_sasaran' => 'required|integer',
            'jenis_standard_id' => 'required',
            'kelompok_standard_id' => 'required',
            'nomor_standard' => 'required|string',
            'judul_standard' => 'required|string',
            'sip_id' => 'required|array', //
            'sasaran_id' => 'required|array', //
        ], [
            'bsip_id.required' => 'BSIP cannot be null',
            'tanggal.required' => 'Tanggal cannot be null',
            'tanggal.date' => 'Invalid data input',
            'metode_id.required' => 'Metode cannot be null',
            'jumlah_sasaran.required' => 'Jumlah sasaran cannot be null',
            'jumlah_sasaran.integer' => 'Invalid data input',
            'jenis_standard_id.required' => 'Jenis Standard cannot be null',
            'kelompok_standard_id.required' => 'Kelompok Standard cannot be null',
            'nomor_standard.required' => 'Nomor standard cannot be null',
            'nomor_standard.string' => 'Invalid data input',
            'judul_standard.required' => 'Judul standard cannot be null',
            'judul_standard.string' => 'Invalid data input',
            'sip_id.required' => 'SIP cannot be null',
            'sip_id.array' => 'Invalid data input',
            'sasaran_id.required' => 'SIP cannot be null',
            'sasaran_id.array' => 'Invalid data input',
        ]); 
        // dd($request->all());
        $data_diseminasi = [
            'bsip_id' => $request->bsip_id,
            'tanggal' => $request->tanggal,
            'metode_id' => $request->metode_id,
            'jumlah_sasaran' => $request->jumlah_sasaran,
            'jenis_standard_id' => $request->jenis_standard_id,
            'kelompok_standard_id' => $request->kelompok_standard_id,
            'nomor_standard' => $request->nomor_standard,
            'judul_standard' => $request->judul_standard,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ];
        $diseminasi = Diseminasi::create($data_diseminasi);
        $diseminasi->sip()->sync($request->sip_id);
        $diseminasi->sasaran()->sync($request->sasaran_id);
        return redirect()->route('diseminasi_beranda')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $diseminasi = Diseminasi::find(Crypt::decryptString($id));
        if (!$diseminasi) return back()->withErrors('data not found');
        $request->validate([
            'bsip_id' => 'required',
            'tanggal' => 'required|date',
            'metode_id' =>  'required',
            'jumlah_sasaran' => 'required|integer',
            'jenis_standard_id' => 'required',
            'kelompok_standard_id' => 'required',
            'nomor_standard' => 'required|string',
            'judul_standard' => 'required|string',
            'sip_id' => 'required|array', //
            'sasaran_id' => 'required|array', //
        ], [
            'bsip_id.required' => 'BSIP cannot be null',
            'tanggal.required' => 'Tanggal cannot be null',
            'tanggal.date' => 'Invalid data input',
            'metode_id.required' => 'Metode cannot be null',
            'jumlah_sasaran.required' => 'Jumlah sasaran cannot be null',
            'jumlah_sasaran.integer' => 'Invalid data input',
            'jenis_standard_id.required' => 'Jenis Standard cannot be null',
            'kelompok_standard_id.required' => 'Kelompok Standard cannot be null',
            'nomor_standard.required' => 'Nomor standard cannot be null',
            'nomor_standard.string' => 'Invalid data input',
            'judul_standard.required' => 'Judul standard cannot be null',
            'judul_standard.string' => 'Invalid data input',
            'sip_id.required' => 'SIP cannot be null',
            'sip_id.array' => 'Invalid data input',
            'sasaran_id.required' => 'SIP cannot be null',
            'sasaran_id.array' => 'Invalid data input',
        ]); 
        $data_diseminasi = [
            'bsip_id' => $request->bsip_id,
            'tanggal' => $request->tanggal,
            'metode_id' => $request->metode_id,
            'jumlah_sasaran' => $request->jumlah_sasaran,
            'jenis_standard_id' => $request->jenis_standard_id,
            'kelompok_standard_id' => $request->kelompok_standard_id,
            'nomor_standard' => $request->nomor_standard,
            'judul_standard' => $request->judul_standard,
            'updated_by' => Auth::user()->id,
        ];
        $diseminasi->update($data_diseminasi);
        $diseminasi->sip()->sync($request->sip_id);
        $diseminasi->sasaran()->sync($request->sasaran_id);
        return redirect()->route('diseminasi_beranda')->with('success', 'updated');
    }

    public function destroy($id) {
        $diseminasi = Diseminasi::find(Crypt::decryptString($id));
        if (!$diseminasi) return back()->withErrors('data not found');
        $diseminasi->delete();
        // return back()->with('success', 'deleted');
        return redirect()->route('diseminasi_beranda')->with('success', 'deleted');
    }
}
