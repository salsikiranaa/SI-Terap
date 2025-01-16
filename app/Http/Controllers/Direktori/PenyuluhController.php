<?php

namespace App\Http\Controllers\Direktori;

use App\Http\Controllers\Controller;
use App\Models\mFungsional;
use App\Models\mKabupaten;
use App\Models\mKecamatan;
use App\Models\mProvinsi;
use App\Models\Penyuluh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PenyuluhController extends Controller
{
    public function index(Request $request) {
        $penyuluh = new Penyuluh();
        if ($request->name) $penyuluh = $penyuluh->where('name', 'LIKE', "%$request->name%");
        if ($request->fungsional_id) $penyuluh = $penyuluh->where('fungsional_id', $request->fungsional_id);
        if ($request->kecamatan_id) $penyuluh = $penyuluh->where('kecamatan_id', $request->kecamatan_id);
        elseif ($request->kabupaten_id) {
            $id_kecamatan = mKecamatan::where('kabupaten_id', $request->kabupaten_id)->distinct()->pluck('id');
            $penyuluh = $penyuluh->whereIn('kecamatan_id', $id_kecamatan);
        }
        elseif ($request->provinsi_id) {
            $id_kabupaten = mKabupaten::where('provinsi_id', $request->provinsi_id)->distinct()->pluck('id');
            $id_kecamatan = mKecamatan::whereIn('kabupaten_id', $id_kabupaten)->distinct()->pluck('id');
            $penyuluh = $penyuluh->whereIn('kecamatan_id', $id_kecamatan);
        }
        $penyuluh = $penyuluh->get();

        $fungsional = mFungsional::get();
        $kecamatan = mKecamatan::get();
        $kabupaten = mKabupaten::get();
        $provinsi = mProvinsi::select(['id', 'name'])->get();
        return view('pengkajian.sdm', [
            'penyuluh' => $penyuluh,
            'fungsional' => $fungsional,
            'kecamatan' => $kecamatan,
            'kabupaten' => $kabupaten,
            'provinsi' => $provinsi,
        ]);
    }

    public function create() {
        $provinsi = mProvinsi::select(['id', 'name'])->get();
        $kabupaten = mKabupaten::get();
        $kecamatan = mKecamatan::get();
        $fungsional = mFungsional::get();
        return view('pengkajian.formsdm', [
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'fungsional' => $fungsional,
        ]);
    }

    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'kecamatan_id' => 'required|numeric',
            'fungsional_id' => 'required|numeric',
            'name' => 'required|string|max:255|unique:penyuluh',
            'contact' => 'required|string|max:255|unique:penyuluh',
        ], [
            'kecamatan_id.required' => 'kecamatan_id is required',
            'fungsional_id.required' => 'fungsional_id is required',
            'name.required' => 'name is required',
            'name.max' => 'name max 255 character',
            'name.unique' => 'name already exist',
            'contact.required' => 'contact is required',
            'contact.max' => 'contact max 255 character',
            'contact.unique' => 'contact already exist',
        ]);
        // dd($request->all());

        Penyuluh::create([
            'kecamatan_id' => $request->kecamatan_id,
            'fungsional_id' => $request->fungsional_id,
            'name' => $request->name,
            'contact' => $request->contact,
        ]);

        return redirect()->route('sdm')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $penyuluh = Penyuluh::find(Crypt::decryptString($id));
        if (!$penyuluh) return back()->withErrors('data not found');
        $request->validate([
            'kecamatan_id' => 'required|numeric',
            'fungsional_id' => 'required|numeric',
            'name' => 'required|string|max:255|unique:penyuluh',
            'contact' => 'required|string|max:255|unique:penyuluh',
        ], [
            'kecamatan_id.required' => 'kecamatan_id is required',
            'fungsional_id.required' => 'fungsional_id is required',
            'name.required' => 'name is required',
            'name.max' => 'name max 255 character',
            'name.unique' => 'name already exist',
            'contact.required' => 'contact is required',
            'contact.max' => 'contact max 255 character',
            'contact.unique' => 'contact already exist',
        ]);

        $penyuluh->update([
            'kecamatan_id' => $request->kecamatan_id,
            'fungsional_id' => $request->fungsional_id,
            'name' => $request->name,
            'contact' => $request->contact,
        ]);

        return redirect()->route('sdm')->with('success', 'updated');
    }
    
    public function destroy($id) {
        $penyuluh = Penyuluh::find(Crypt::decryptString($id));
        if (!$penyuluh) return back()->withErrors('data not found');
        $penyuluh->delete();
        return redirect()->route('sdm')->with('success', 'deleted');
    }
}
