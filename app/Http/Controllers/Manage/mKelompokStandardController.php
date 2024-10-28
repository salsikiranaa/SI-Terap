<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mKelompokStandard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mKelompokStandardController extends Controller
{
    public function get() {
        $kelompok = mKelompokStandard::get();
        return $kelompok;
        // return view('<manage kelompok standard view>', ['kelompok' => $kelompok]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:m_kelompok_standard'
        ], [
            'name.required' => 'Kelompok Standard name is required',
            'name.string' => 'Kelompok Standard name must be a string',
            'name.max' => 'Kelompok Standard name must not be greater than 255 characters',
            'name.unique' => 'Kelompok Standard name already exists'
        ]);
        $kelompok = mKelompokStandard::create(['name' => $request->name]);
        // return 'created';
        return redirect()->route('manage.kelompok_standard.view')->with('success', 'data created');
    }

    public function update($id, Request $request) {
        $kelompok = mKelompokStandard::find(Crypt::decryptString($id));
        if (!$kelompok) return back()->withErrors('cannot found kelompok');
        $request->validate([
            'name' => 'required|string|max:255|unique:m_kelompok_standard'
        ], [
            'name.required' => 'Kelompok Standard name is required',
            'name.string' => 'Kelompok Standard name must be a string',
            'name.max' => 'Kelompok Standard name must not be greater than 255 characters',
            'name.unique' => 'Kelompok Standard name already exists'
        ]);
        $kelompok->update(['name' => $request->name]);
        // return 'updated';
        return redirect()->route('manage.kelompok_standard.view')->with('success', 'data updated');
    }

    public function destroy($id) {
        $kelompok = mKelompokStandard::find(Crypt::decryptString($id));
        if (!$kelompok) return back()->withErrors('cannot found kelompok');
        $kelompok->delete();
        // return 'deleted';
        return redirect()->route('manage.kelompok_standard.view')->with('success', 'data deleted');
    }
}
