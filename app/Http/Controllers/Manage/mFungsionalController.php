<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mFungsional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mFungsionalController extends Controller
{
    public function index() {
        $fungsional = mFungsional::get();
        return $fungsional;
        // return view('manage fungsional view path', [
        //     'fungsional' => $fungsional,
        // ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|unique:m_fungsional',
        ], [
            'name.required' => 'name cannot be null',
            'name.string' => 'name type must be string',
            'name.unique' => 'this name already exist',
        ]);
        $fungsional = mFungsional::create(['name' => $request->name]);
        if (!$fungsional) return back()->withErrors('failed to store data');
        return redirect()->route('manage.fungsional.view')->with('success', 'created');
    }

    public function update($id, Request $request) {
        $fungsional = mFungsional::find(Crypt::decryptString($id));
        if (!$fungsional) return back()->withErrors('cannot found this data');
        $request->validate([
            'name' => 'required|string|unique:m_fungsional',
        ], [
            'name.required' => 'name cannot be null',
            'name.string' => 'name type must be string',
            'name.unique' => 'this name already exist',
        ]);
        $fungsional = $fungsional->update(['name' => $request->name]);
        if (!$fungsional) return back()->withErrors('failed to save data change');
        return redirect()->route('manage.fungsional.view')->with('success', 'updated');
    }

    public function destroy($id) {
        $fungsional = mFungsional::find(Crypt::decryptString($id));
        if (!$fungsional) return back()->withErrors('cannot found this data');
        $fungsional->delete();
        if ($fungsional) return back()->withErrors('failed to delete data');
        return redirect()->route('manage.fungsional.view')->with('success', 'deleted');
    }
}
