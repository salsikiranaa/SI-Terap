<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mProvinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mProvinsiController extends Controller
{
    public function get(Request $request) {
        $provinsi = new mProvinsi();
        if ($request->search) $provinsi = $provinsi->where('name', 'LIKE', "%$request->search%");
        $provinsi = $provinsi->paginate(10);
        return view('manage.provinsi.index', ['provinsi' => $provinsi]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:m_provinsi',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ], [
            'name.required' => 'Provinsi name cannot be null',
            'name.string' => 'Provinsi name must be a string',
            'name.max' => 'Provinsi name must not be more than 255 characters',
            'name.unique' => 'Provinsi name already exists',
            'longitude.required' => 'Longitude cannot be null',
            'longitude.numeric' => 'Longitude must be a number',
            'latitude.required' => 'Latitude cannot be null',
            'latitude.numeric' => 'Latitude must be a number',
        ]);

        mProvinsi::create([
            'name' => $request->name,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        // return back()->with('success', 'created');
        return redirect()->route('manage.provinsi.view')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $provinsi = mProvinsi::find(Crypt::decryptString($id));
        if (!$provinsi) return back()->withErrors('data not found');
        $request->validate([
            'name' => 'required|string|max:255',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ], [
            'name.required' => 'Provinsi name cannot be null',
            'name.string' => 'Provinsi name must be a string',
            'name.max' => 'Provinsi name must not be more than 255 characters',
            'name.unique' => 'Provinsi name already exists',
            'longitude.required' => 'Longitude cannot be null',
            'longitude.numeric' => 'Longitude must be a number',
            'latitude.required' => 'Latitude cannot be null',
            'latitude.numeric' => 'Latitude must be a number',
        ]);
        $provinsi->update([
            'name' => $request->name,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);
        // return back()->with('success', 'updated');
        return redirect()->route('manage.provinsi.view')->with('success', 'updated');
    }

    public function destroy($id) {
        $provinsi = mProvinsi::find(Crypt::decryptString($id));
        if (!$provinsi) return back()->withErrors('data not found');
        $provinsi->delete();
        // return back()->with('success', 'deleted');
        return redirect()->route('manage.provinsi.view')->with('success', 'deleted');
    }
    
    public function apiGet() {
        $provinsi = mProvinsi::get();
        return $provinsi;
    }
}
