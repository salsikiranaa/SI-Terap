<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CommonDataController extends Controller
{
    public function index(Request $request, $name, $table) {
        $table = Crypt::decryptString($table);
        $data = DB::table($table);
        if ($request->search) $data = $data->where('name', 'LIKE', "%$request->search%");
        $data = $data->paginate(10);
        return view('manage.common.index', [
            'name' => $name,
            'data' => $data,
        ]);
    }

    public function store(Request $request, $table) {
        $table = Crypt::decryptString($table);
        $request->validate([
            'name' => "required|string|max:255|unique:$table"
        ], [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not be greater than 255 characters',
            'name.unique' => 'Name already exists',
        ]);
        $data = DB::table($table)->insert([
            'name' => $request->name,
        ]);
        if (!$data) return back()->withErrors('failed to insert data');
        return back()->with('success', 'created');
    }

    public function update(Request $request, $table, $id) {
        $table = Crypt::decryptString($table);
        $id = Crypt::decryptString($id);
        $data = DB::table($table)->find($id);
        if (!$data) return back()->withErrors('data not found');
        $request->validate([
            'name' => "required|string|max:255|unique:$table"
        ], [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not be greater than 255 characters',
            'name.unique' => 'Name already exists',
        ]);
        DB::table($table)
            ->where('id', $id)
            ->update([
                'name' => $request->name,
            ]);
        return back()->with('success', 'updated');
    }
    
    public function destroy($table, $id) {
        $table = Crypt::decryptString($table);
        $id = Crypt::decryptString($id);
        $data = DB::table($table)->find($id);
        if (!$data) return back()->withErrors('data not found');
        DB::table($table)->delete($id);
        return back()->with('success', 'deleted');
    }
}
