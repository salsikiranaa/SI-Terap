<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mIP2SIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mIP2SIPController extends Controller
{
    public function get() {
        $ip2sip = mIP2SIP::get();
        return $ip2sip;
        // return view('<manage ip2sip view>', ['ip2sip' => $ip2sip]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'bsip_id' => 'required',
            'luas_lahan' => 'required|double',
        ], [
            'name.required' => 'BSIP name is required',
            'name.string' => 'BSIP name must be a string',
            'name.max' => 'BSIP name must not be greater than 255 characters',
            'bsip_id.required' => 'BSIP id name is required',
            'luas_lahan.required' => 'BSIP luas_lahan is required',
            'luas_lahan.double' => 'BSIP luas_lahan must be a double',
        ]);
        $ip2sip = mIP2SIP::create([
            'name' => $request->name,
            'bsip_id' => $request->bsip_id,
            'luas_lahan' => $request->luas_lahan,
        ]);
        // return 'created';
        return redirect()->route('manage.ip2sip.view')->with('success', 'data created');
    }

    public function update($id, Request $request) {
        $ip2sip = mIP2SIP::find(Crypt::decryptString($id));
        if (!$ip2sip) return back()->withErrors('cannot found ip2sip');
        $request->validate([
            'name' => 'required|string|max:255',
            'bsip_id' => 'required',
            'luas_lahan' => 'required|double',
        ], [
            'name.required' => 'BSIP name is required',
            'name.string' => 'BSIP name must be a string',
            'name.max' => 'BSIP name must not be greater than 255 characters',
            'bsip_id.required' => 'BSIP id name is required',
            'luas_lahan.required' => 'BSIP luas_lahan is required',
            'luas_lahan.double' => 'BSIP luas_lahan must be a double',
        ]);
        $ip2sip->update([
            'name' => $request->name,
            'bsip_id' => $request->bsip_id,
            'luas_lahan' => $request->luas_lahan,
        ]);
        // return 'updated';
        return redirect()->route('manage.ip2sip.view')->with('success', 'data updated');
    }

    public function destroy($id) {
        $ip2sip = mIP2SIP::find(Crypt::decryptString($id));
        if (!$ip2sip) return back()->withErrors('cannot found ip2sip');
        $ip2sip->delete();
        // return 'deleted';
        return redirect()->route('manage.ip2sip.view')->with('success', 'data deleted');
    }
}
