<?php

namespace App\Http\Controllers\IP2SIP;

use App\Http\Controllers\Controller; // Tambahkan ini
use App\Models\mBSIP;
use App\Models\PemanfaatanSIP;
use Illuminate\Http\Request;

class provinceDashboardController extends Controller
{
    public function show($bsip_id)
    {
        $bsip = mBSIP::find($bsip_id);
        if (!$bsip) return back()->withErrors('BSIP Belum terdaftar');
        $ip2sip_id = $bsip->ip2sip->pluck('id');
        $pemanfaatan_sip = PemanfaatanSIP::whereIn('ip2sip_id', $ip2sip_id)->get();
        // dd($pemanfaatan_sip);

        $bsip_ip2sip = mBSIP::whereHas('ip2sip')->get();
        return view('lp2tp.tabelPeta', [
            'bsip' => $bsip,
            'bsip_ip2sip' => $bsip_ip2sip,
            'pemanfaatan_sip' => $pemanfaatan_sip,
        ]);
    }
}
