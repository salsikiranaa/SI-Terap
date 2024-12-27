<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mKabupaten;
use App\Models\mKecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mKecamatanController extends Controller
{
    public function get(Request $request) {
        $kecamatan = new mKecamatan();
        if ($request->search) $kecamatan = $kecamatan->where('name', 'LIKE', "%$request->search%");
        $kecamatan = $kecamatan->paginate(10);
        $kabupaten = mKabupaten::select(['id', 'name'])->get();
        return view('manage.kecamatan.index', ['kecamatan' => $kecamatan, 'kabupaten' => $kabupaten]);
    }

    public function store(Request $request) {
        $request->validate([
            'kabupaten_id' => 'required',
            'name' => 'required|string|max:255|unique:m_kecamatan'
        ], [
            'kabupaten_id.required' => 'Kabupaten cannot be null',
            'name.required' => 'Kecamatan name cannot be null',
            'name.string' => 'Kecamatan name must be a string',
            'name.max' => 'Kecamatan name must be less than 255 characters',
            'name.unique' => 'Kecamatan name already exists'
        ]);
        mKecamatan::create([
            'kabupaten_id' => $request->kabupaten_id,
            'name' => $request->name
        ]);
        return redirect()->route('manage.kecamatan.view')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $kecamatan = mKecamatan::find(Crypt::decryptString($id));
        if (!$kecamatan) return back()->withErrors('data not found');
        $request->validate([
            'kabupaten_id' => 'required',
            'name' => 'required|string|max:255'
        ], [
            'kabupaten_id.required' => 'Kabupaten cannot be null',
            'name.required' => 'Kecamatan name cannot be null',
            'name.string' => 'Kecamatan name must be a string',
            'name.max' => 'Kecamatan name must be less than 255 characters',
            'name.unique' => 'Kecamatan name already exists'
        ]);
        $kecamatan->update([
            'kabupaten_id' => $request->kabupaten_id,
            'name' => $request->name
        ]);
        return redirect()->route('manage.kecamatan.view')->with('success', 'updated');
    }

    public function destroy($id) {
        $kecamatan = mKecamatan::find(Crypt::decryptString($id));
        if (!$kecamatan) return back()->withErrors('data not found');
        $kecamatan->delete();
        return redirect()->route('manage.kecamatan.view')->with('success', 'deleted');
    }
    
    public function apiGet() {
        $kecamatan = mKecamatan::get();
        return $kecamatan;
    }
    
    public function apiGetByKabupaten($kabupaten_id) {
        $kecamatan = mKecamatan::where('kabupaten_id', Crypt::decryptString($kabupaten_id))->get();
        return $kecamatan;
    }
}
