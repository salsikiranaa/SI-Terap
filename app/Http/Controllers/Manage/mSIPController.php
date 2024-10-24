<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mSIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mSIPController extends Controller
{
    public function get() {
        $sip = mSIP::get();
        return $sip;
        // return view('<manage sip view>', ['sip' => $sip]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'SIP name is required',
            'name.string' => 'SIP name must be a string',
            'name.max' => 'SIP name must not be greater than 255 characters'
        ]);
        $sip = mSIP::create(['name' => $request->name]);
        return 'created';
        // return redirect()->route('<manage sip route>')->with('success', 'data created');
    }

    public function update($id, Request $request) {
        $sip = mSIP::find(Crypt::decryptString($id));
        if (!$sip) return back()->withErrors('cannot found sip');
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'SIP name is required',
            'name.string' => 'SIP name must be a string',
            'name.max' => 'SIP name must not be greater than 255 characters'
        ]);
        $sip->update(['name' => $request->name]);
        return 'updated';
        // return redirect()->route('<manage sip route>')->with('success', 'data updated');
    }

    public function destroy($id) {
        $sip = mSIP::find(Crypt::decryptString($id));
        if (!$sip) return back()->withErrors('cannot found sip');
        $sip->delete();
        return 'deleted';
        // return redirect()->route('<manage sip route>')->with('success', 'data deleted');
    }
}
