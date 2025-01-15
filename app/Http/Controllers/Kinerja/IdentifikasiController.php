<?php

namespace App\Http\Controllers\Kinerja;

use App\Http\Controllers\Controller;
use App\Models\Identifikasi;
use App\Models\mBSIP;
use App\Models\mMetode;
use App\Models\mSasaran;
use App\Models\mSIP;
use App\Models\pIdentifikasiSasaran;
use App\Models\pIdentifikasiSIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class IdentifikasiController extends Controller
{
    public function index() {
        $bsip = mBSIP::whereHas('identifikasi')->distinct()->get();
        // dd($bsip[0]->identifikasi);
        foreach ($bsip as $b) {
            $b->provinsi = $b->provinsi;
            $b->value = count($b->identifikasi);
            $b['hc-key'] = $b->id;
        }
        return view('kinerja.identifikasi.beranda', [
            'bsip' => $bsip,
        ]);
    }

    public function provinsi($bsip_id, Request $request) {
        $bsip = mBSIP::whereHas('identifikasi')->distinct()->get();
        $identifikasi = Identifikasi::where('bsip_id', $bsip_id);
        if ($request->tahun) $identifikasi = $identifikasi->where('tahun', $request->tahun);
        if ($request->jenis_usulan) $identifikasi = $identifikasi->where('jenis_usulan', $request->jenis_usulan);
        $identifikasi = $identifikasi->get();
        $bsip_identifikasi = mBSIP::find($bsip_id);
        if (!$bsip_identifikasi) return back()->withErrors('provinsi belum terdaftar');
        $bsip_identifikasi = $bsip_identifikasi->provinsi;
        return view('kinerja.identifikasi.provinsi', [
            'bsip' => $bsip,
            'identifikasi' => $identifikasi,
            'bsip_identifikasi' => $bsip_identifikasi,
        ]);
    }

    public function filter_provinsi(Request $request) {
        $request->validate(['bsip_id' => 'required']);
        return redirect()->route('identifikasi.provinsi', $request->except('_token'));
    }

    public function create(Request $request) {
        $bsip = mBSIP::get();
        $sasaran = mSasaran::get();
        $sip = mSIP::get();
        $metode = mMetode::get();
        return view('kinerja.identifikasi.form_sip', [
            'bsip' => $bsip,
            'sasaran' => $sasaran,
            'sip' => $sip,
            'metode' => $metode,
        ]);
    }

    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'bsip_id' => 'required',
            'tahun' => 'required',
            'metode_id' =>  'required',
            'jenis_usulan' => 'required|in:revisi,baru',
            'sip_id' => 'required|array',
            'sip_id.*' => 'integer',
            'sasaran_id' => 'required|array',
            'sasaran_id.*' => 'integer',
        ], [
            'bsip_id.required' => 'BSIP cannot be null',
            'tahun.required' => 'tahun cannot be null',
            'metode_id.required' => 'Metode cannot be null',
            'jenis_usulan.required' => 'Jenis usulan cannot be null',
            'jenis_usulan.in' => 'Jenis usulan must be one of the following: revisi or baru',
            'sip_id.required' => 'SIP cannot be null',
            'sip_id.array' => 'Invalid data input',
            'sip_id.*.Integer' => 'Invalid data input',
            'sasaran_id.required' => 'SIP cannot be null',
            'sasaran_id.array' => 'Invalid data input',
            'sasaran_id.*.Integer' => 'Invalid data input',
        ]);

        // dd($request->all());

        $data_identifikasi = [
            'bsip_id' => $request->bsip_id,
            'tahun' => $request->tahun,
            'metode_id' => $request->metode_id,
            'jenis_usulan' => $request->jenis_usulan,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ];
        $identifikasi = Identifikasi::create($data_identifikasi);

        $identifikasi->sip()->sync($request->sip_id);
        $identifikasi->sasaran()->sync($request->sasaran_id);
        return redirect()->route('identifikasi_beranda')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $identifikasi = Identifikasi::find(Crypt::decryptString($id));
        if (!$identifikasi) return back()->withErrors('data not found');
        $request->validate([
            'bsip_id' => 'required',
            'tahun' => 'required',
            'metode_id' =>  'required',
            'jenis_usulan' => 'required|in:revisi,baru',
            'sip_id' => 'required|array',
            'sip_id.*' => 'integer',
            'sasaran_id' => 'required|array',
            'sasaran_id.*' => 'integer',
        ], [
            'bsip_id.required' => 'BSIP cannot be null',
            'tahun.required' => 'tahun cannot be null',
            'metode_id.required' => 'Metode cannot be null',
            'jenis_usulan.required' => 'Jenis usulan cannot be null',
            'jenis_usulan.in' => 'Jenis usulan must be one of the following: revisi or baru',
            'sip_id.required' => 'SIP cannot be null',
            'sip_id.array' => 'Invalid data input',
            'sip_id.*.Integer' => 'Invalid data input',
            'sasaran_id.required' => 'SIP cannot be null',
            'sasaran_id.array' => 'Invalid data input',
            'sasaran_id.*.Integer' => 'Invalid data input',
        ]);

        $data_identifikasi = [
            'bsip_id' => $request->bsip_id,
            'tahun' => $request->tahun,
            'metode_id' => $request->metode_id,
            'jenis_usulan' => $request->jenis_usulan,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ];
        $identifikasi->update($data_identifikasi);

        $identifikasi->sip()->sync($request->sip_id);
        $identifikasi->sasaran()->sync($request->sasaran_id);
        return redirect()->route('identifikasi_beranda')->with('success', 'updated');
    }

    public function exportPdf($bsip_id)
    {
        $identifikasi = Identifikasi::where('bsip_id', $bsip_id)->get();

        $pdf = PDF::loadView('kinerja.identifikasi.pdf', ['identifikasi' => $identifikasi]);

        return $pdf->download('identifikasi-provinsi.pdf');
    }
}
