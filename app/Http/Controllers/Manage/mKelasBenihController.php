<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mKelasBenih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mKelasBenihController extends Controller
{
    public function index() {
        $kelas_benih = mKelasBenih::get();
        return $kelas_benih;
        // return view('manage.kelas_benih.index', [
        //     'kelas_benih' => $kelas_benih,
        // ]);
    }

    public function create() {
        return 'create kelas_benih';
        // return view('manage.kelas_benih.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:m_kelas_benih',
        ], [
            'name.required' => 'Nama kelas_benih harus diisi',
            'name.string' => 'Nama kelas_benih harus berupa string',
            'name.max' => 'Nama kelas_benih tidak boleh lebih dari 255 karakter',
            'name.unique' => 'Nama kelas_benih sudah ada',
        ]);
        mKelasBenih::create([
            'name' => $request->name,
        ]);
        return redirect()->route('manage.kelas_benih.view')->with('success', 'created');
    }

    public function edit($id) {
        $kelas_benih = mKelasBenih::find(Crypt::decryptString($id));
        if (!$kelas_benih) return back()->withErrors('data not found');
        return 'edit kelas_benih';
        // return view('manage.kelas_benih.edit', [
        //     'kelas_benih' => $kelas_benih,
        // ]);
    }

    public function update($id, Request $request) {
        $kelas_benih = mKelasBenih::find(Crypt::decryptString($id));
        if (!$kelas_benih) return back()->withErrors('data not found');
        $request->validate([
            'name' => 'required|string|max:255|unique:m_kelas_benih',
        ], [
            'name.required' => 'Nama kelas_benih harus diisi',
            'name.string' => 'Nama kelas_benih harus berupa string',
            'name.max' => 'Nama kelas_benih tidak boleh lebih dari 255 karakter',
            'name.unique' => 'Nama kelas_benih sudah ada',
        ]);
        $kelas_benih->update([
            'name' => $request->name,
        ]);
        return redirect()->route('manage.kelas_benih.view')->with('success', 'created');
    }
    
    public function destroy($id) {
        $kelas_benih = mKelasBenih::find(Crypt::decryptString($id));
        if (!$kelas_benih) return back()->withErrors('data not found');
        $kelas_benih->delete();
        return redirect()->route('manage.kelas_benih.view')->with('success', 'deleted');
    }
}
