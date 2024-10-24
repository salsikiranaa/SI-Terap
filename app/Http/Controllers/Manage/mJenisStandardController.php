<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mJenisStandard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mJenisStandardController extends Controller
{
    public function get() {
        $jenis = mJenisStandard::get();
        return $jenis;
        // return view('<manage jenis standard view>', ['jenis' => $jenis]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Jenis Standard name is required',
            'name.string' => 'Jenis Standard name must be a string',
            'name.max' => 'Jenis Standard name must not be greater than 255 characters'
        ]);
        $jenis = mJenisStandard::create(['name' => $request->name]);
        return 'created';
        // return redirect()->route('<manage jenis standard route>')->with('success', 'data created');
    }

    public function update($id, Request $request) {
        $jenis = mJenisStandard::find(Crypt::decryptString($id));
        if (!$jenis) return back()->withErrors('cannot found jenis');
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Jenis Standard name is required',
            'name.string' => 'Jenis Standard name must be a string',
            'name.max' => 'Jenis Standard name must not be greater than 255 characters'
        ]);
        $jenis->update(['name' => $request->name]);
        return 'updated';
        // return redirect()->route('<manage jenis standard route>')->with('success', 'data updated');
    }

    public function destroy($id) {
        $jenis = mJenisStandard::find(Crypt::decryptString($id));
        if (!$jenis) return back()->withErrors('cannot found jenis');
        $jenis->delete();
        return 'deleted';
        // return redirect()->route('<manage jenis standard route>')->with('success', 'data deleted');
    }
}
