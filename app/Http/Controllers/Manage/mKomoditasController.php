<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mKomoditas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mKomoditasController extends Controller
{
    public function index() {
        $komoditas = mKomoditas::get();
        return $komoditas;
        // return view('manage.komoditas.index', [
        //     'komoditas' => $komoditas,
        // ]);
    }

    public function create() {
        return 'create komoditas';
        // return view('manage.komoditas.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:m_komoditas',
        ], [
            'name.required' => 'Nama komoditas harus diisi',
            'name.string' => 'Nama komoditas harus berupa string',
            'name.max' => 'Nama komoditas tidak boleh lebih dari 255 karakter',
            'name.unique' => 'Nama komoditas sudah ada',
        ]);
        mKomoditas::create([
            'name' => $request->name,
        ]);
        return redirect()->route('manage.komoditas.view')->with('success', 'created');
    }

    public function edit($id) {
        $komoditas = mKomoditas::find(Crypt::decryptString($id));
        if (!$komoditas) return back()->withErrors('data not found');
        return 'edit komoditas';
        // return view('manage.komoditas.edit', [
        //     'komoditas' => $komoditas,
        // ]);
    }

    public function update($id, Request $request) {
        $komoditas = mKomoditas::find(Crypt::decryptString($id));
        if (!$komoditas) return back()->withErrors('data not found');
        $request->validate([
            'name' => 'required|string|max:255|unique:m_komoditas',
        ], [
            'name.required' => 'Nama komoditas harus diisi',
            'name.string' => 'Nama komoditas harus berupa string',
            'name.max' => 'Nama komoditas tidak boleh lebih dari 255 karakter',
            'name.unique' => 'Nama komoditas sudah ada',
        ]);
        $komoditas->update([
            'name' => $request->name,
        ]);
        return redirect()->route('manage.komoditas.view')->with('success', 'created');
    }
    
    public function destroy($id) {
        $komoditas = mKomoditas::find(Crypt::decryptString($id));
        if (!$komoditas) return back()->withErrors('data not found');
        $komoditas->delete();
        return redirect()->route('manage.komoditas.view')->with('success', 'deleted');
    }
}
