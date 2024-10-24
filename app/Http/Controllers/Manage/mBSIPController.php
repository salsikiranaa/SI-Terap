<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mBSIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mBSIPController extends Controller
{
    public function get() {
        $bsip = mBSIP::get();
        return $bsip;
        // return view('<manage bsip view>', ['bsip' => $bsip]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255|unique:m_bsip',
            'alamat' => 'required|text|unique:m_bsip',
        ], [
            'name.required' => 'BSIP name is required',
            'name.string' => 'BSIP name must be a string',
            'name.max' => 'BSIP name must not be greater than 255 characters',
            'provinsi.required' => 'BSIP provinsi name is required',
            'provinsi.string' => 'BSIP provinsi name must be a string',
            'provinsi.max' => 'BSIP provinsi name must not be greater than 255 characters',
            'provinsi.unique' => 'provinsi is already taken',
            'alamat.required' => 'BSIP alamat is required',
            'alamat.text' => 'BSIP alamat must be a text',
            'alamat.unique' => 'alamat is already taken',
        ]);
        $bsip = mBSIP::create([
            'name' => $request->name,
            'provinsi' => $request->provinsi,
            'alamat' => $request->alamat,
        ]);
        return 'created';
        // return redirect()->route('<manage bsip route>')->with('success', 'data created');
    }

    public function update($id, Request $request) {
        $bsip = mBSIP::find(Crypt::decryptString($id));
        if (!$bsip) return back()->withErrors('cannot found bsip');
        $request->validate([
            'name' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255|unique:m_bsip',
            'alamat' => 'required|text|unique:m_bsip',
        ], [
            'name.required' => 'BSIP name is required',
            'name.string' => 'BSIP name must be a string',
            'name.max' => 'BSIP name must not be greater than 255 characters',
            'provinsi.required' => 'BSIP provinsi name is required',
            'provinsi.string' => 'BSIP provinsi name must be a string',
            'provinsi.max' => 'BSIP provinsi name must not be greater than 255 characters',
            'provinsi.unique' => 'provinsi is already taken',
            'alamat.required' => 'BSIP alamat is required',
            'alamat.text' => 'BSIP alamat must be a text',
            'alamat.unique' => 'alamat is already taken',
        ]);
        $bsip->update([
            'name' => $request->name,
            'provinsi' => $request->provinsi,
            'alamat' => $request->alamat,
        ]);
        return 'updated';
        // return redirect()->route('<manage bsip route>')->with('success', 'data updated');
    }

    public function destroy($id) {
        $bsip = mBSIP::find(Crypt::decryptString($id));
        if (!$bsip) return back()->withErrors('cannot found bsip');
        $bsip->delete();
        return 'deleted';
        // return redirect()->route('<manage bsip route>')->with('success', 'data deleted');
    }
}
