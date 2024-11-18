<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Models\Riset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RisetController extends Controller
{
    public function get() {
        $riset = Riset::get();
        return $riset;
        // return view('<riset view>', ['riset' => $riset]);
    }
    
    public function getById($id) {
        $riset = Riset::find(Crypt::decryptString($id));
        if (!$riset) return back()->withErrors('data not found');
        return $riset;
        // return view('<riset detail view>', ['riset' => $riset]);
    }

    public function store(Request $request) {
        $request->validate([
            'kecamatan_id' => 'required',
            'judul' => 'required|string|max:255|unique:riset',
        ], [
            'kecamatan_id.required' => 'kecamatan_id is required',
            'judul.required' => 'judul is required',
            'judul.string' => 'judul must be a string',
            'judul.max' => 'judul must be max 255 character',
            'judul.unique' => 'judul already exist',
        ]);

        Riset::create([
            'kecamatan_id' => $request->kecamatan_id,
            'judul' => $request->judul,
        ]);

        return redirect()->route('lab.riset.view')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $riset = Riset::find(Crypt::decryptString($id));
        if (!$riset) return back()->withErrors('data not found');
        $request->validate([
            'kecamatan_id' => 'required',
            'judul' => 'required|string|max:255|unique:riset',
        ], [
            'kecamatan_id.required' => 'kecamatan_id is required',
            'judul.required' => 'judul is required',
            'judul.string' => 'judul must be a string',
            'judul.max' => 'judul must be max 255 character',
            'judul.unique' => 'judul already exist',
        ]);

        $riset->update([
            'kecamatan_id' => $request->kecamatan_id,
            'judul' => $request->judul,
        ]);

        return redirect()->route('lab.riset.view')->with('success', 'updated');
    }
    
    public function destroy($id) {
        $riset = Riset::find(Crypt::decryptString($id));
        if (!$riset) return back()->withErrors('data not found');
        $riset->delete();
        return redirect()->route('lab.riset.view')->with('success', 'deleted');
    }
}
