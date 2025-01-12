<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\BsipProfile;
use App\Models\mBSIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class BsipProfileController extends Controller
{
    public function index(
        // $m_bsip_id
    ) {
        // $profile = BsipProfile::find($m_bsip_id);
        $profile = BsipProfile::first();
        return view('profile', ['profile' => $profile]);
    }

    public function manage(Request $request) {
        $profiles = new BsipProfile();
        if ($request->search) {
            $m_bsip_id = mBSIP::where('name', 'LIKE', "%$request->search%")->distinct()->pluck('id');
            $profiles = $profiles->whereIn('m_bsip_id', $m_bsip_id);
        }
        $profiles = $profiles->paginate(10);
        $m_bsip = mBSIP::doesntHave('bsip_profile')->select(['id', 'name'])->get();
        return view('manage.profile.index', [
            'profiles' => $profiles,
            'm_bsip' => $m_bsip
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'm_bsip_id' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|mimes:png,jpg,jpeg'
        ], [
            'm_bsip_id.required' => 'Mandatory field',
            'm_bsip_id.numeric' => 'Invalid value',
            'description.required' => 'Mandatory field',
            'description.string' => 'Invalid value',
            'image.required' => 'Mandatory field',
            'image.mimes' => 'Invalid file type'
        ]);
        if (!$request->hasFile('image')) return back()->withErrors('file image required');
        $target_directory = storage_path('/app/public/profile-bsip');
        if (!File::isDirectory($target_directory)) File::makeDirectory($target_directory, 0755, true);
        $filename = $request->file('image')->hashName();
        $file_url = "/storage/profile-bsip/$filename";
        $request->image->move($target_directory, $filename);
        $profile = BsipProfile::create([
            'm_bsip_id' => $request->m_bsip_id,
            'description' => $request->description,
            'image_url' => $file_url
        ]);
        if (!$profile) return back()->withErrors('failed to store data');
        return redirect()->route('manage.profile_bsip.index')->with('success', 'Profile created successfully');
    }

    public function update($id, Request $request) {
        $id = Crypt::decryptString($id);
        $profile = BsipProfile::find($id);
        if (!$profile) return back()->withErrors('data not found');
        $request->validate([
            'description' => 'required|string',
            'image' => 'mimes:jpg,jpeg,png'
        ], [
            'description.required' => 'Mandatory field',
            'description.string' => 'Invalid value',
            'image.mimes' => 'Invalid file type'
        ]);
        $data = [ 'description' => $request->description ];
        if ($request->hasFile('image')) {
            if (File::exists(storage_path('/app/public'.str_replace('/storage', '', $profile->image_url)))) {
                File::delete(storage_path('/app/public'.str_replace('/storage', '', $profile->image_url)));
            }

            $target_directory = storage_path('/app/public/profile-bsip');
            if (!File::isDirectory($target_directory)) File::makeDirectory($target_directory, 0755, true);
            $filename = $request->file('image')->hashName();
            $file_url = "/storage/profile-bsip/$filename";
            $request->image->move($target_directory, $filename);
            $data['image_url'] = $file_url;
        }
        $profile->update($data);
        return redirect()->route('manage.profile_bsip.index')->with('success', 'Profile created successfully');
    }

    public function destroy($id) {
        $id = Crypt::decryptString($id);
        $profile = BsipProfile::find($id);
        if (!$profile) return back()->withErrors('data not found');
        if (File::exists(storage_path('/app/public'.str_replace('/storage', '', $profile->image_url)))) {
            File::delete(storage_path('/app/public'.str_replace('/storage', '', $profile->image_url)));
        }
        $profile->delete();
        return redirect()->route('manage.profile_bsip.index')->with('success', 'Profile deleted successfully');
    }
}
