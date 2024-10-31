<?php

namespace App\Http\Controllers\Kinerja;

use App\Http\Controllers\Controller;
use App\Models\Diseminasi;
use App\Models\pDiseminasiSasaran;
use App\Models\pDiseminasiSIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DiseminasiController extends Controller
{
    public function get() {
        $diseminasi = Diseminasi::get();
        return $diseminasi;
        // return view('<diseminasi view>', ['diseminasi' => $diseminasi]);
    }
    
    public function getById($id) {
        $diseminasi = Diseminasi::find(Crypt::decryptString($id));
        if (!$diseminasi) return back()->withErrors('data not found');
        return $diseminasi;
        // return view('<diseminasi detail view>', ['diseminasi' => $diseminasi]);
    }

    public function store(Request $request) {
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
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ];
        $diseminasi = Diseminasi::create($data_diseminasi);
        $p_sip = $request->sip_id->map(function ($item) use ($diseminasi) {
            return ['diseminasi_id' => $diseminasi->id, 'sip_id' => $item];
        });
        $p_sasaran = $request->sasaran_id->map(function ($item) use ($diseminasi) {
            return ['diseminasi_id' => $diseminasi->id, 'sasaran_id' => $item];
        });
        $diseminasi->sip()->saveMany($p_sip);
        $diseminasi->sasaran()->saveMany($p_sasaran);
        return back()->with('success', 'created');
        // return redirect()->route('<diseminasi view>')->with('success', 'created');
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
        $diseminasi = Diseminasi::create($data_diseminasi);
        $p_sip = $request->sip_id->map(function ($item) use ($diseminasi) {
            return ['diseminasi_id' => $diseminasi->id, 'sip_id' => $item];
        });
        $p_sasaran = $request->sasaran_id->map(function ($item) use ($diseminasi) {
            return ['diseminasi_id' => $diseminasi->id, 'sasaran_id' => $item];
        });
        pDiseminasiSIP::where('diseminasi_id', $diseminasi->id)->delete();
        pDiseminasiSasaran::where('diseminasi_id', $diseminasi->id)->delete();
        $diseminasi->sip()->saveMany($p_sip);
        $diseminasi->sasaran()->saveMany($p_sasaran);
        return back()->with('success', 'updated');
        // return redirect()->route('<diseminasi view>')->with('success', 'updated');
    }

    public function destroy($id) {
        $diseminasi = Diseminasi::find(Crypt::decryptString($id));
        if (!$diseminasi) return back()->withErrors('data not found');
        $diseminasi->delete();
        return back()->with('success', 'deleted');
        // return redirect()->route('<diseminasi view>')->with('success', 'deleted');
    }
}
