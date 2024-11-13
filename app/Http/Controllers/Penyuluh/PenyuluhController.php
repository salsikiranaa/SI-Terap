<?php

namespace App\Http\Controllers\Penyuluh;

use App\Http\Controllers\Controller;
use App\Models\Penyuluh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PenyuluhController extends Controller
{
    public function get() {
        $penyuluh = Penyuluh::get();
        return $penyuluh;
        // return view('<penyuluh view>', ['penyuluh' => $penyuluh]);
    }

    public function getById($id) {
        $penyuluh = Penyuluh::find(Crypt::decryptString($id));
        if (!$penyuluh) return back()->withErrors('data not found');
        return $penyuluh;
        // return view('<puluh detail view>', ['penyuluh' => $penyuluh]);
    }

    public function store(Request $request) {
        $request->validate([
            'kecamatan_id' => 'required',
            'nama_bpp' => 'required|string|max:255|unique:penyuluh',
            'alamat_bpp' => 'required|string|unique:penyuluh',
            'kontak_bpp' => 'required|string|max:255|unique:penyuluh',
        ], [
            'kecamatan_id.required' => 'kecamatan_id is required',
            'nama_bpp.required' => 'nama_bpp is required',
            'nama_bpp.string' => 'nama_bpp must be a string',
            'nama_bpp.max' => 'nama_bpp must be max 255 character',
            'nama_bpp.unique' => 'nama_bpp already exist',
            'alamat_bpp.required' => 'alamat_bpp is required',
            'alamat_bpp.string' => 'alamat_bpp must be a string',
            'alamat_bpp.unique' => 'alamat_bpp already exist',
            'kontak_bpp.required' => 'kontak_bpp is required',
            'kontak_bpp.string' => 'kontak_bpp must be a string',
            'kontak_bpp.max' => 'kontak_bpp must be max 255 character',
            'kontak_bpp.unique' => 'kontak_bpp already exist',
        ]);

        Penyuluh::create([
            'kecamatan_id' => $request->kecamatan_id,
            'nama_bpp' => $request->nama_bpp,
            'alamat_bpp' => $request->alamat_bpp,
            'kontak_bpp' => $request->kontak_bpp,
        ]);

        return redirect()->route('direktori_penyuluh.penyuluh.view')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $penyuluh = Penyuluh::find(Crypt::decryptString($id));
        if (!$penyuluh) return back()->withErrors('data not found');
        $request->validate([
            'kecamatan_id' => 'required',
            'nama_bpp' => 'required|string|max:255|unique:penyuluh',
            'alamat_bpp' => 'required|string|unique:penyuluh',
            'kontak_bpp' => 'required|string|max:255|unique:penyuluh',
        ], [
            'kecamatan_id.required' => 'kecamatan_id is required',
            'nama_bpp.required' => 'nama_bpp is required',
            'nama_bpp.string' => 'nama_bpp must be a string',
            'nama_bpp.max' => 'nama_bpp must be max 255 character',
            'nama_bpp.unique' => 'nama_bpp already exist',
            'alamat_bpp.required' => 'alamat_bpp is required',
            'alamat_bpp.string' => 'alamat_bpp must be a string',
            'alamat_bpp.unique' => 'alamat_bpp already exist',
            'kontak_bpp.required' => 'kontak_bpp is required',
            'kontak_bpp.string' => 'kontak_bpp must be a string',
            'kontak_bpp.max' => 'kontak_bpp must be max 255 character',
            'kontak_bpp.unique' => 'kontak_bpp already exist',
        ]);

        $penyuluh->update([
            'kecamatan_id' => $request->kecamatan_id,
            'nama_bpp' => $request->nama_bpp,
            'alamat_bpp' => $request->alamat_bpp,
            'kontak_bpp' => $request->kontak_bpp,
        ]);

        return redirect()->route('direktori_penyuluh.penyuluh.view')->with('success', 'updated');
    }
    
    public function destroy($id) {
        $penyuluh = Penyuluh::find(Crypt::decryptString($id));
        if (!$penyuluh) return back()->withErrors('data not found');
        $penyuluh->delete();
        return redirect()->route('direktori_penyuluh.penyuluh.view')->with('success', 'deleted');
    }
}
