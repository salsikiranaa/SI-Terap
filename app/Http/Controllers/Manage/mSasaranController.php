<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mSasaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mSasaranController extends Controller
{
    public function get() {
        $sasaran = mSasaran::get();
        return $sasaran;
        // return view('<manage sasaran view>', ['sasaran' => $sasaran]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Sasaran name is required',
            'name.string' => 'Sasaran name must be a string',
            'name.max' => 'Sasaran name must not be greater than 255 characters'
        ]);
        $sasaran = mSasaran::create(['name' => $request->name]);
        return 'created';
        // return redirect()->route('<manage sasaran route>')->with('success', 'data created');
    }

    public function update($id, Request $request) {
        $sasaran = mSasaran::find(Crypt::decryptString($id));
        if (!$sasaran) return back()->withErrors('cannot found sasaran');
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Sasaran name is required',
            'name.string' => 'Sasaran name must be a string',
            'name.max' => 'Sasaran name must not be greater than 255 characters'
        ]);
        $sasaran->update(['name' => $request->name]);
        return 'updated';
        // return redirect()->route('<manage sasaran route>')->with('success', 'data updated');
    }

    public function destroy($id) {
        $sasaran = mSasaran::find(Crypt::decryptString($id));
        if (!$sasaran) return back()->withErrors('cannot found sasaran');
        $sasaran->delete();
        return 'deleted';
        // return redirect()->route('<manage sasaran route>')->with('success', 'data deleted');
    }
}
