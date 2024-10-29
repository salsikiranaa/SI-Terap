<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mKecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mKecamatanController extends Controller
{
    public function get() {
        $kecamatan = mKecamatan::get();
        return $kecamatan;
        // return view('<manage kecamatan view>', ['kecamatan' => $kecamatan]);
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
            'name' => 'required|string|max:255|unique:m_kecamatan'
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
}
