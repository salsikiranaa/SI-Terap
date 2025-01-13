<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class ManageGalleryController extends Controller
{
    public function manage(Request $request) {
        $gallery = new Gallery();
        if ($request->search) $gallery = $gallery->where('title', 'LIKE', "%$request->search%");
        $gallery = $gallery->paginate(10);

        return view('manage.gallery.index', [
            'gallery' => $gallery
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);
        if (!$request->hasFile('image')) return back()->withErrors('image file required');
        $target_dir = storage_path('/app/public/gallery');
        if (!File::isDirectory($target_dir)) File::makeDirectory($target_dir);
        $filename = $request->file('image')->hashName();
        $image_url = "/storage/gallery/$filename";
        $gallery = Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $image_url
        ]);
        if (!$gallery) return back()->withErrors('failed to store data');
        $request->file('image')->move($target_dir, $filename);
        return redirect()->route('manage.gallery.index')->with('success', 'store data successful');
    }

    public function update($id, Request $request) {
        $id = Crypt::decryptString($id);
        $gallery = Gallery::find($id);
        if (!$gallery) return back()->withErrors('gallery not found');
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        $data = [
            'title' => $request->title,
            'description' => $request->description
        ];
        if ($request->hasFile('image')) {
            if (File::exists(storage_path('/app/public'.str_replace('/storage', '', $gallery->image_url)))) File::delete(storage_path('/app/public'.str_replace('/storage', '', $gallery->image_url)));
            $filename = $request->file('image')->hashName();
            $request->file('image')->move(storage_path('/app/public/gallery/'), $filename);
            $image_url = "/storage/gallery/$filename";
            $data['image_url'] = $image_url;
        }
        $gallery->update($data);
        return redirect()->route('manage.gallery.index')->with('success', 'update data successful');
    }

    public function destroy($id) {
        $id = Crypt::decryptString($id);
        $gallery = Gallery::find($id);
        if (!$gallery) return back()->withErrors('gallery not found');
        if (File::exists(storage_path('/app/public'.str_replace('/storage', '', $gallery->image_url)))) File::delete(storage_path('/app/public'.str_replace('/storage', '', $gallery->image_url)));
        $gallery->delete();
        return back()->with('success', 'delete data successful');
    }
}
