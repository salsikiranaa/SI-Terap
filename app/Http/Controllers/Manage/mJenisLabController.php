<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mJenisLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mJenisLabController extends Controller
{
    public function index() {
        $jenis_lab = mJenisLab::get();
        return $jenis_lab;
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|unique:m_jenis_lab',
        ], [
            'name.required' => 'Nama jenis lab tidak boleh kosong',
            'name.string' => 'Tipe data tidak sesuai',
            'name.unique' => 'jenis ini telah ada',
        ]);
        $jenis_lab = mJenisLab::create([
            'name' => $request->name,
        ]);
        if (!$jenis_lab) return back()->withErrors('failed to store data');
        return redirect()->route('manage.jenis_lab.view')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $jenis_lab = mJenisLab::find(Crypt::decryptString($id));
        if (!$jenis_lab) return back()->withErrors('data not found');
        $request->validate([
            'name' => 'required|string|unique:m_jenis_lab',
        ], [
            'name.required' => 'Nama jenis lab tidak boleh kosong',
            'name.string' => 'Tipe data tidak sesuai',
            'name.unique' => 'jenis ini telah ada',
        ]);
        $jenis_lab = $jenis_lab->update([
            'name' => $request->name,
        ]);
        if (!$jenis_lab) return back()->withErrors('failed to update data');
        return redirect()->route('manage.jenis_lab.view')->with('success', 'updated');
    }

    public function destroy($id) {
        $jenis_lab = mJenisLab::find(Crypt::decryptString($id));
        if (!$jenis_lab) return back()->withErrors('data not found');
        $jenis_lab->delete();
        if ($jenis_lab) return back()->withErrors('failed to delete data');
        return redirect()->route('manage.jenis_lab.view')->with('success', 'deleted');
    }
}
