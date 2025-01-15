<?php

namespace App\Http\Controllers\IP2SIP;

use App\Http\Controllers\Controller;
use App\Models\AsetRumah;
use App\Models\mBSIP;
use App\Models\mIP2SIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AsetRumahController extends Controller
{
    public function index(Request $request) {
        $aset_rumah = new AsetRumah();
        if ($request->bsip_id) {
            $ip2sip_id = mIP2SIP::where('bsip_id', $request->bsip_id)->distinct()->pluck('id');
            $$aset_rumah = $aset_rumah->whereIn('ip2sip_id', $ip2sip_id);
        }
        $aset_rumah = $aset_rumah->paginate(10);
        $all_bsip = mBSIP::select(['id', 'name'])->get();
        return view('lp2tp.aset.rumah_negara', [
            'aset_rumah' => $aset_rumah,
            'all_bsip' => $all_bsip,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'ip2sip_id' => 'required|numeric',
            'jenis_aset' => 'required|string',
            'luas_lahan' => 'required|numeric',
            'tahun_perolehan' => 'required',
            'bukti_kepemilikan' => 'required|string',
            'nomor_sertifikat' => 'required|string',
            'pj_sertifikat' => 'required|string',
        ], [
            'ip2sip_id.required' => 'IP2SIP tidak boleh kosong',
            'jenis_aset.required' => 'Jenis aset tidak boleh kosong',
            'luas_lahan.required' => 'Luas lahan tidak boleh kosong',
            'tahun_perolehan.required' => 'Tahun perolehan tidak boleh kosong',
            'bukti_kepemilikan.required' => 'Bukti kepemilikan tidak boleh kosong',
            'nomor_sertifikat.required' => 'Nomor sertifikat tidak boleh kosong',
            'pj_sertifikat.required' => 'PJ sertifikat tidak boleh kosong',
        ]);
        $aset_rumah = AsetRumah::create([
            'ip2sip_id' => $request->ip2sip_id,
            'jenis_aset' => $request->jenis_aset,
            'luas_lahan' => $request->luas_lahan,
            'tahun_perolehan' => $request->tahun_perolehan,
            'bukti_kepemilikan' => $request->bukti_kepemilikan,
            'nomor_sertifikat' => $request->nomor_sertifikat,
            'pj_sertifikat' => $request->pj_sertifikat,
        ]);
        if (!$aset_rumah) return back()->withErrors('failed to store data');
        return redirect()->route('aset.rumah_negara')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $aset_rumah = AsetRumah::find(Crypt::decryptString($id));
        if (!$aset_rumah) return back()->withErrors('data not found');
        $request->validate([
            'ip2sip_id' => 'required|numeric',
            'jenis_aset' => 'required|string',
            'luas_lahan' => 'required|numeric',
            'tahun_perolehan' => 'required',
            'bukti_kepemilikan' => 'required|string',
            'nomor_sertifikat' => 'required|string',
            'pj_sertifikat' => 'required|string',
        ], [
            'ip2sip_id.required' => 'IP2SIP tidak boleh kosong',
            'jenis_aset.required' => 'Jenis aset tidak boleh kosong',
            'luas_lahan.required' => 'Luas lahan tidak boleh kosong',
            'tahun_perolehan.required' => 'Tahun perolehan tidak boleh kosong',
            'bukti_kepemilikan.required' => 'Bukti kepemilikan tidak boleh kosong',
            'nomor_sertifikat.required' => 'Nomor sertifikat tidak boleh kosong',
            'pj_sertifikat.required' => 'PJ sertifikat tidak boleh kosong',
        ]);
        $aset_rumah = $aset_rumah->update([
            'ip2sip_id' => $request->ip2sip_id,
            'jenis_aset' => $request->jenis_aset,
            'luas_lahan' => $request->luas_lahan,
            'tahun_perolehan' => $request->tahun_perolehan,
            'bukti_kepemilikan' => $request->bukti_kepemilikan,
            'nomor_sertifikat' => $request->nomor_sertifikat,
            'pj_sertifikat' => $request->pj_sertifikat,
        ]);
        if (!$aset_rumah) return back()->withErrors('failed to update data');
        return redirect()->route('aset.rumah_negara')->with('success', 'updated');
    }

    public function destroy($id) {
        $aset_rumah = AsetRumah::find(Crypt::decryptString($id));
        if (!$aset_rumah) return back()->withErrors('data not found');
        $aset_rumah->delete();
        if ($aset_rumah) return back()->withErrors('failed to delete data');
        return redirect()->route('aset.rumah_negara')->with('success', 'deleted');
    }
}
