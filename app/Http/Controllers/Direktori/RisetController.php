<?php

namespace App\Http\Controllers\Direktori;

use App\Http\Controllers\Controller;
use App\Models\mKabupaten;
use App\Models\mKecamatan;
use App\Models\mProvinsi;
use App\Models\mSIP;
use App\Models\Riset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RisetController extends Controller
{
    public function index(Request $request) {
        $riset = new Riset();
        if ($request->tahun) $riset = $riset->where('tahun', $request->tahun);
        if ($request->sip_id) $riset = $riset->where('sip_id', $request->sip_id);
        if ($request->kecamatan_id) $riset = $riset->where('kecamatan_id', $request->kecamatan_id);
        elseif ($request->kabupaten_id) {
            $id_kecamatan = mKecamatan::where('kabupaten_id', $request->kabupaten_id)->distinct()->pluck('id');
            $riset = $riset->whereIn('kecamatan_id', $id_kecamatan);
        }
        elseif ($request->provinsi_id) {
            $id_kabupaten = mKabupaten::where('provinsi_id', $request->provinsi_id)->distinct()->pluck('id');
            $id_kecamatan = mKecamatan::whereIn('kabupaten_id', $id_kabupaten)->distinct()->pluck('id');
            $riset = $riset->whereIn('kecamatan_id', $id_kecamatan);
        }
        $riset = $riset->get();

        $sip = mSIP::get();
        $provinsi = mProvinsi::select(['id', 'name'])->get();
        $kabupaten = mKabupaten::get();
        $kecamatan = mKecamatan::get();
        return view('pengkajian.riset', [
            'riset' => $riset,
            'sip' => $sip,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
        ]);
    }

    public function create() {
        $sip = mSIP::get();
        $provinsi = mProvinsi::select(['id', 'name'])->get();
        $kabupaten = mKabupaten::get();
        $kecamatan = mKecamatan::get();
        return view('pengkajian.formriset', [
            'sip' => $sip,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'kecamatan_id' => 'required|numeric',
            'sip_id' => 'required|numeric',
            'judul' => 'required|string|max:255',
            'tahun' => 'required',
        ], [
            'kecamatan_id.required' => 'kecamatan_id is required',
            'kecamatan_id.numeric' => 'kecamatan_id must be numeric',
            'sip_id.required' => 'sip_id is required',
            'sip_id.numeric' => 'sip_id must be numeric',
            'judul.required' => 'judul is required',
            'judul.string' => 'judul must be a string',
            'judul.max' => 'judul must be max 255 character',
            'tahun.required' => 'tahun is required',
        ]);

        Riset::create([
            'kecamatan_id' => $request->kecamatan_id,
            'sip_id' => $request->sip_id,
            'judul' => $request->judul,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('riset')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $riset = Riset::find(Crypt::decryptString($id));
        if (!$riset) return back()->withErrors('data not found');
        $request->validate([
            'kecamatan_id' => 'required|numeric',
            'sip_id' => 'required|numeric',
            'judul' => 'required|string|max:255',
            'tahun' => 'required',
        ], [
            'kecamatan_id.required' => 'kecamatan_id is required',
            'kecamatan_id.numeric' => 'kecamatan_id must be numeric',
            'sip_id.required' => 'sip_id is required',
            'sip_id.numeric' => 'sip_id must be numeric',
            'judul.required' => 'judul is required',
            'judul.string' => 'judul must be a string',
            'judul.max' => 'judul must be max 255 character',
            'tahun.required' => 'tahun is required',
        ]);

        $riset->update([
            'kecamatan_id' => $request->kecamatan_id,
            'sip_id' => $request->sip_id,
            'judul' => $request->judul,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('riset')->with('success', 'updated');
    }
    
    public function destroy($id) {
        $riset = Riset::find(Crypt::decryptString($id));
        if (!$riset) return back()->withErrors('data not found');
        $riset->delete();
        return redirect()->route('riset')->with('success', 'deleted');
    }
}
