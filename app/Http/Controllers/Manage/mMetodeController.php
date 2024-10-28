<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mMetode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mMetodeController extends Controller
{
    public function get() {
        $metode = mMetode::get();
        return $metode;
        // return view('<manage metode view>', ['metode' => $metode]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:m_metode'
        ], [
            'name.required' => 'Metode name is required',
            'name.string' => 'Metode name must be a string',
            'name.max' => 'Metode name must not be greater than 255 characters',
            'name.unique' => 'Metode name already exists'
        ]);
        $metode = mMetode::create(['name' => $request->name]);
        // return 'created';
        return redirect()->route('manage.metode.view')->with('success', 'data created');
    }

    public function update($id, Request $request) {
        $metode = mMetode::find(Crypt::decryptString($id));
        if (!$metode) return back()->withErrors('cannot found metode');
        $request->validate([
            'name' => 'required|string|max:255|unique:m_metode'
        ], [
            'name.required' => 'Metode name is required',
            'name.string' => 'Metode name must be a string',
            'name.max' => 'Metode name must not be greater than 255 characters',
            'name.unique' => 'Metode name already exists'
        ]);
        $metode->update(['name' => $request->name]);
        // return 'updated';
        return redirect()->route('manage.metode.view')->with('success', 'data updated');
    }

    public function destroy($id) {
        $metode = mMetode::find(Crypt::decryptString($id));
        if (!$metode) return back()->withErrors('cannot found metode');
        $metode->delete();
        // return 'deleted';
        return redirect()->route('manage.metode.view')->with('success', 'data deleted');
    }
}
