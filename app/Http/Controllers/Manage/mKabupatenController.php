<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mKabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mKabupatenController extends Controller
{
    public function get() {
        $kabupaten = mKabupaten::get();
        return $kabupaten;
        // return view('<manage kabupaten view>', ['kabupaten' => $kabupaten]);
    }

    public function store(Request $request) {
        $request->validate([
            'provinsi_id' => 'required',
            'name' => 'required|string|max:255|unique:m_kabupaten'
        ], [
            'provinsi_id.required' => 'Provinsi cannot be null',
            'name.required' => 'Kabupaten name cannot be null',
            'name.string' => 'Kabupaten name must be a string',
            'name.max' => 'Kabupaten name must be less than 255 characters',
            'name.unique' => 'Kabupaten name already exists'
        ]);
        mKabupaten::create([
            'provinsi_id' => $request->provinsi_id,
            'name' => $request->name
        ]);
        return redirect()->route('manage.kabupaten.view')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $kabupaten = mKabupaten::find(Crypt::decryptString($id));
        if (!$kabupaten) return back()->withErrors('data not found');
        $request->validate([
            'provinsi_id' => 'required',
            'name' => 'required|string|max:255|unique:m_kabupaten'
        ], [
            'provinsi_id.required' => 'Provinsi cannot be null',
            'name.required' => 'Kabupaten name cannot be null',
            'name.string' => 'Kabupaten name must be a string',
            'name.max' => 'Kabupaten name must be less than 255 characters',
            'name.unique' => 'Kabupaten name already exists'
        ]);
        $kabupaten->update([
            'provinsi_id' => $request->provinsi_id,
            'name' => $request->name
        ]);
        return redirect()->route('manage.kabupaten.view')->with('success', 'updated');
    }

    public function destroy($id) {
        $kabupaten = mKabupaten::find(Crypt::decryptString($id));
        if (!$kabupaten) return back()->withErrors('data not found');
        $kabupaten->delete();
        return redirect()->route('manage.kabupaten.view')->with('success', 'deleted');
    }

    public function apiGet() {
        $kabupaten = mKabupaten::get();
        return $kabupaten;
    }

    public function apiGetByProvinsi($provinsi_id) {
        $kabupaten = mKabupaten::where('provinsi_id', Crypt::decryptString($provinsi_id))->get();
        return $kabupaten;
    }
}
