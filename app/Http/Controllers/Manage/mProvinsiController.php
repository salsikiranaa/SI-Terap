<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mProvinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mProvinsiController extends Controller
{
    public function get() {
        $provinsi = mProvinsi::get();
        return $provinsi;
        // return view('<manage provinsi view>', ['provinsi' => $provinsi]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:m_provinsi'
        ], [
            'name.required' => 'Provinsi name cannot be null',
            'name.string' => 'Provinsi name must be a string',
            'name.max' => 'Provinsi name must not be more than 255 characters',
            'name.unique' => 'Provinsi name already exists'
        ]);

        mProvinsi::create(['name' => $request->name]);

        // return back()->with('success', 'created');
        return redirect()->route('manage.provinsi.view')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $provinsi = mProvinsi::find(Crypt::decryptString($id));
        if (!$provinsi) return back()->withErrors('data not found');
        $request->validate([
            'name' => 'required|string|max:255|unique:m_provinsi'
        ], [
            'name.required' => 'Provinsi name cannot be null',
            'name.string' => 'Provinsi name must be a string',
            'name.max' => 'Provinsi name must not be more than 255 characters',
            'name.unique' => 'Provinsi name already exists'
        ]);
        $provinsi->update(['name' => $request->name]);
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
