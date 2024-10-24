<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class mServiceController extends Controller
{
    public function get() {
        $services = mService::get();
        return $services;
        // return view('<manage service view>', ['services' => $services]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Service name is required',
            'name.string' => 'Service name must be a string',
            'name.max' => 'Service name must not be greater than 255 characters'
        ]);
        $service = mService::create(['name' => $request->name]);
        return 'created';
        // return redirect()->route('<manage service route>')->with('success', 'data created');
    }

    public function update($id, Request $request) {
        $service = mService::find(Crypt::decryptString($id));
        if (!$service) return back()->withErrors('cannot found service');
        $request->validate([
            'name' => 'required|string|max:255'
        ], [
            'name.required' => 'Service name is required',
            'name.string' => 'Service name must be a string',
            'name.max' => 'Service name must not be greater than 255 characters'
        ]);
        $service->update(['name' => $request->name]);
        return 'updated';
        // return redirect()->route('<manage service route>')->with('success', 'data updated');
    }

    public function destroy($id) {
        $service = mService::find(Crypt::decryptString($id));
        if (!$service) return back()->withErrors('cannot found service');
        $service->delete();
        return 'deleted';
        // return redirect()->route('<manage service route>')->with('success', 'data deleted');
    }
}
