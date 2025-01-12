<?php

namespace App\Http\Controllers\IP2SIP;

use App\Http\Controllers\Controller;
use App\Models\DetailPemanfaatanSip;
use Illuminate\Http\Request;

class DetailPemanfaatanSipController extends Controller
{
    public function index($pemanfaatan_id) {
        $detail = DetailPemanfaatanSip::
            where('pemanfaatan_sip_id', $pemanfaatan_id)
            ->paginate(10);
        return $detail;
    }

    public function create() {
        // return view("...");
        return "form create detail";
    }

    public function store(Request $request) {
        $request->validate([
            'pemanfaatan_sip_id' => 'required|numeric',
            'tahun' => 'required|numeric',
            'luas' => 'required|numeric',
            'program' => 'array',
            'program.*.program' => 'string'
        ], [
            'pemanfaatan_sip_id.required' => 'pemanfaatan_sip id cannot be null',
            'pemanfaatan_sip_id.numeric' => 'pemanfaatan_sip id must be type of numeric',
            'tahun.required' => 'tahun cannot be null',
            'tahun.numeric' => 'tahun must be type of numeric',
            'luas.required' => 'luas cannot be null',
            'luas.numeric' => 'luas must be type of numeric',
            'program.array' => 'program must be array',
            'program.*.program.string' => 'program must be string'
        ]);
        $detail = DetailPemanfaatanSip::create([
            'pemanfaatan_sip_id' => $request->pemanfaatan_sip_id,
            'tahun' => $request->tahun,
            'luas' => $request->luas
        ]);
        if (!$detail) return back()->withErrors('cannot store data');
        $program = $detail->program_pemanfaatan_sip()->sync($request->program);
        if (!$program) return back()->withErrors('failed to insert program list');
        return redirect()->route('lp2tp.pemanfaatan_kp.detail');
    }

    public function edit($id) {
        $detail = DetailPemanfaatanSip::find($id)->paginate(10);
        // return view("...", ['detail' => $detail]);
        return "form edit detail";
    }

    public function update($id, Request $request) {
        $detail = DetailPemanfaatanSip::find($id);
        if (!$detail) return back()->withErrors('data not found');
        $request->validate([
            'tahun' => 'required|numeric',
            'luas' => 'required|numeric',
            'program' => 'array',
            'program.*.program' => 'string'
        ], [
            'tahun.required' => 'tahun cannot be null',
            'tahun.numeric' => 'tahun must be type of numeric',
            'luas.required' => 'luas cannot be null',
            'luas.numeric' => 'luas must be type of numeric',
            'program.array' => 'program must be array',
            'program.*.program.string' => 'program must be string'
        ]);
        $updated = $detail->update([
            'pemanfaatan_sip_id' => $request->pemanfaatan_sip_id,
            'tahun' => $request->tahun,
            'luas' => $request->luas
        ]);
        if ($updated == $detail) return back()->withErrors('cannot update data');
        $program = $detail->program_pemanfaatan_sip()->sync($request->program);
        return redirect()->route('lp2tp.pemanfaatan_kp.detail');
    }

    public function destroy($id) {
        $detail = DetailPemanfaatanSip::find($id);
        if (!$detail) return back()->withErrors('data not found');
        $detail->delete();
        if ($detail) return back()->withErrors('cannot delete data');
        return redirect()->route('lp2tp.pemanfaatan_kp.detail');
    }
}
