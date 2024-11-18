<?php

namespace App\Http\Controllers\Kinerja;

use App\Http\Controllers\Controller;
use App\Models\Identifikasi;
use App\Models\pIdentifikasiSasaran;
use App\Models\pIdentifikasiSIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class IdentifikasiController extends Controller
{
    public function get() {
        $identifikasi = Identifikasi::get();
        return $identifikasi;
        // return view('<identifikasi view>', ['identifikasi' => $identifikasi]);
    }

    public function getById($id) {
        $identifikasi = Identifikasi::find(Crypt::decryptString($id));
        if (!$identifikasi) return back()->withErrors('data not found');
        return $identifikasi;
        // return view('<identifikasi detail view>', ['identifikasi' => $identifikasi]);
    }

    public function store(Request $request) {
        $request->validate([
            'bsip_id' => 'required',
            'tanggal' => 'required|date',
            'metode_id' =>  'required',
            'jenis_usulan' => 'required|in:revisi,baru',
            'sip_id' => 'required|array', //
            'sasaran_id' => 'required|array', //
        ], [
            'bsip_id.required' => 'BSIP cannot be null',
            'tanggal.required' => 'Tanggal cannot be null',
            'tanggal.date' => 'Invalid data input',
            'metode_id.required' => 'Metode cannot be null',
            'jenis_usulan.required' => 'Jenis usulan cannot be null',
            'jenis_usulan.in' => 'Jenis usulan must be one of the following: revisi or baru',
            'sip_id.required' => 'SIP cannot be null',
            'sip_id.array' => 'Invalid data input',
            'sasaran_id.required' => 'SIP cannot be null',
            'sasaran_id.array' => 'Invalid data input',
        ]);

        $data_identifikasi = [
            'bsip_id' => $request->bsip_id,
            'tanggal' => $request->tanggal,
            'metode_id' => $request->metode_id,
            'jenis_usulan' => $request->jenis_usulan,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ];
        $identifikasi = Identifikasi::create($data_identifikasi);

        $p_sip = [];
        foreach ($request->sip_id as $id) {
            $p_sip[] = ['identifikasi_id' => $identifikasi->id, 'sip_id' => $id];
        }
        $p_sasaran = [];
        foreach ($request->sasaran_id as $id) {
            $p_sasaran[] = ['identifikasi_id' => $identifikasi->id, 'sasaran_id' => $id];
        }
        DB::table('p_identifikasi_sip')->insert($p_sip);
        DB::table('p_identifikasi_sasaran')->insert($p_sasaran);
        // return back()->with('success', 'created');
        return redirect()->route('kinerja.identifikasi.view')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $identifikasi = Identifikasi::find(Crypt::decryptString($id));
        if (!$identifikasi) return back()->withErrors('data not found');
        $request->validate([
            'bsip_id' => 'required',
            'tanggal' => 'required|date',
            'metode_id' =>  'required',
            'jenis_usulan' => 'required|in:revisi,baru',
            'sip_id' => 'required|array', //
            'sasaran_id' => 'required|array', //
        ], [
            'bsip_id.required' => 'BSIP cannot be null',
            'tanggal.required' => 'Tanggal cannot be null',
            'tanggal.date' => 'Invalid data input',
            'metode_id.required' => 'Metode cannot be null',
            'jenis_usulan.required' => 'Jenis usulan cannot be null',
            'jenis_usulan.in' => 'Jenis usulan must be one of the following: revisi or baru',
            'sip_id.required' => 'SIP cannot be null',
            'sip_id.array' => 'Invalid data input',
            'sasaran_id.required' => 'SIP cannot be null',
            'sasaran_id.array' => 'Invalid data input',
        ]);

        $data_identifikasi = [
            'bsip_id' => $request->bsip_id,
            'tanggal' => $request->tanggal,
            'metode_id' => $request->metode_id,
            'jenis_usulan' => $request->jenis_usulan,
            'updated_by' => Auth::user()->id,
        ];
        $identifikasi->update($data_identifikasi);

        $p_sip = [];
        foreach ($request->sip_id as $id) {
            $p_sip[] = ['identifikasi_id' => $identifikasi->id, 'sip_id' => $id];
        }
        $p_sasaran = [];
        foreach ($request->sasaran_id as $id) {
            $p_sasaran[] = ['identifikasi_id' => $identifikasi->id, 'sasaran_id' => $id];
        }
        pIdentifikasiSIP::where('identifikasi_id', $identifikasi->id)->delete();
        pIdentifikasiSasaran::where('identifikasi_id', $identifikasi->id)->delete();
        DB::table('p_identifikasi_sip')->insert($p_sip);
        DB::table('p_identifikasi_sasaran')->insert($p_sasaran);
        // return back()->with('success', 'updated');
        return redirect()->route('kinerja.identifikasi.view')->with('success', 'updated');
    }

    public function destroy($id) {
        $identifikasi = Identifikasi::find(Crypt::decryptString($id));
        if (!$identifikasi) return back()->withErrors('data not found');
        $identifikasi->delete();
        // return back()->with('success', 'delete data successful');
        return redirect()->route('kinerja.identifikasi.view')->with('success', 'deleted');
    }
}
