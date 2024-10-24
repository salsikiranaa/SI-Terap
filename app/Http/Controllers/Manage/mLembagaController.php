<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mLembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mLembagaController extends Controller
{
    public function get() {
        $lembaga = mLembaga::get();
        return $lembaga;
        // return view('<manage lembaga view>', ['lembaga' => $lembaga]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Lembaga name is required',
            'name.string' => 'Lembaga name must be a string',
            'name.max' => 'Lembaga name must not be greater than 255 characters'
        ]);
        $lembaga = mLembaga::create(['name' => $request->name]);
        return 'created';
        // return redirect()->route('<manage lembaga route>')->with('success', 'data created');
    }

    public function update($id, Request $request) {
        $lembaga = mLembaga::find(Crypt::decryptString($id));
        if (!$lembaga) return back()->withErrors('cannot found lembaga');
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Lembaga name is required',
            'name.string' => 'Lembaga name must be a string',
            'name.max' => 'Lembaga name must not be greater than 255 characters'
        ]);
        $lembaga->update(['name' => $request->name]);
        return 'updated';
        // return redirect()->route('<manage lembaga route>')->with('success', 'data updated');
    }

    public function destroy($id) {
        $lembaga = mLembaga::find(Crypt::decryptString($id));
        if (!$lembaga) return back()->withErrors('cannot found lembaga');
        $lembaga->delete();
        return 'deleted';
        // return redirect()->route('<manage lembaga route>')->with('success', 'data deleted');
    }
}
