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
            'provinsi_id' => 'required|unique:m_bsip',
            'alamat' => 'required|string|unique:m_bsip',
        ], [
            'name.required' => 'BSIP name is required',
            'name.string' => 'BSIP name must be a string',
            'name.max' => 'BSIP name must not be greater than 255 characters',
            'provinsi_id.required' => 'BSIP provinsi name is required',
            'provinsi_id.unique' => 'provinsi is already taken',
            'alamat.required' => 'BSIP alamat is required',
            'alamat.string' => 'BSIP alamat must be a string',
            'alamat.unique' => 'alamat is already taken',
        ]);
        $bsip = mBSIP::create([
            'name' => $request->name,
            'provinsi_id' => $request->provinsi_id,
            'alamat' => $request->alamat,
        ]);
        // return 'created';
        return redirect()->route('manage.bsip.view')->with('success', 'data created');
    }

    public function update($id, Request $request) {
        $bsip = mBSIP::find(Crypt::decryptString($id));
        if (!$bsip) return back()->withErrors('cannot found bsip');
        $request->validate([
            'name' => 'required|string|max:255',
            'provinsi_id' => 'required',
            'alamat' => 'required|string',
        ], [
            'name.required' => 'BSIP name is required',
            'name.string' => 'BSIP name must be a string',
            'name.max' => 'BSIP name must not be greater than 255 characters',
            'provinsi_id.required' => 'BSIP provinsi name is required',
            // 'provinsi_id.unique' => 'provinsi is already taken',
            'alamat.required' => 'BSIP alamat is required',
            'alamat.string' => 'BSIP alamat must be a string',
            // 'alamat.unique' => 'alamat is already taken',
        ]);
        $bsip->update([
            'name' => $request->name,
            'provinsi_id' => $request->provinsi_id,
            'alamat' => $request->alamat,
        ]);
        // return 'updated';
        return redirect()->route('manage.bsip.view')->with('success', 'data updated');
    }

    public function destroy($id) {
        $bsip = mBSIP::find(Crypt::decryptString($id));
        if (!$bsip) return back()->withErrors('cannot found bsip');
        $bsip->delete();
        // return 'deleted';
        return redirect()->route('manage.bsip.view')->with('success', 'data deleted');
    }
}
