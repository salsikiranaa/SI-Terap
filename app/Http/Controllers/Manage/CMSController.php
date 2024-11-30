<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class CMSController extends Controller
{
    public function index() {
        $cms = CMS::first();
        $social = Social::get();
        return view('manage.cms', [
            'cms' => $cms,
            'social' => $social,
        ]);
    }

    public function cms_update(Request $request) {
        $request->validate([
            'institute' => 'required|string',
            'app_name' => 'required|string',
            'description' => 'required|string',
            'contact_1' => 'required|string',
            'contact_2' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'website' => 'required|string',

            'logo_light' => 'mimes:png,jpg,jpeg|max:2048',
            'logo_green' => 'mimes:png,jpg,jpeg|max:2048',
        ], [
            'institute.required' => 'Institute name is required',
            'institute.string' => 'invalid type',
            'app_name.required' => 'App name is required',
            'app_name.string' => 'invalid type',
            'description.required' => 'Description is required',
            'description.string' => 'invalid type',
            'contact_1.required' => 'Contact 1 is required',
            'contact_1.string' => 'invalid type',
            'contact_2.required' => 'Contact 2 is required',
            'contact_2.string' => 'invalid type',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email',
            'address.required' => 'Address is required',
            'address.string' => 'invalid type',
            'website.required' => 'Website is required',
            'website.string' => 'invalid type',
            'logo_light.mimes' => 'Invalid file type',
            'logo_light.max' => 'File size should not be more than 2MB',
            'logo_green.mimes' => 'Invalid file type',
            'logo_green.max' => 'File size should not be more than 2MB',
        ]);
        $cms = CMS::find(1);
        $cms->update([
            'institute' => $request->institute,
            'app_name' => $request->app_name,
            'description' => $request->description,
            'contact_1' => $request->contact_1,
            'contact_2' => $request->contact_2,
            'email' => $request->email,
            'address' => $request->address,
            'website' => $request->website,
            'updated_by' => Auth::user()->id,
        ]);

        if ($request->hasFile('logo_light')) {
            if (File::exists(storage_path('app/public/cms/logo_light.png'))) File::delete(storage_path('app/public/cms/logo_light.png'));
            $request->logo_light->move(storage_path('app/public/cms'), 'logo_light.png');
        }
        if ($request->hasFile('logo_green')) {
            if (File::exists(storage_path('app/public/cms/logo_green.png'))) File::delete(storage_path('app/public/cms/logo_green.png'));
            $request->logo_green->move(storage_path('app/public/cms'), 'logo_green.png');
        }

        return redirect()->route('manage.cms.view')->with('success', 'updated');
    }

    public function social_store(Request $request){
        $request->validate([
            'name' => 'required|in:facebook,instagram,youtube,tiktiok,x-twitter|unique:social',
            'url' => 'required|string|unique:social',
        ], [
            'name.required' => 'Name is required',
            'name.in' => 'Invalid social media',
            'name.unique' => 'Name already exists',
            'url.required' => 'Url is required',
            'url.string' => 'invalid type',
            'url.unique' => 'Url already exists',
        ]);

        Social::create([
            'name' => $request->name,
            'url' => $request->url,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('manage.cms.view')->with('success', 'created');
    }

    public function social_update($id, Request $request){
        $social = Social::find(Crypt::decryptString($id));
        if (!$social) return back()->withErrors('cannot find this social media');

        $request->validate([
            'name' => 'required|in:facebook,instagram,youtube,tiktiok,x-twitter',
            'url' => 'required|string|unique:social',
        ], [
            'name.required' => 'Name is required',
            'name.in' => 'Invalid social media',
            'name.unique' => 'Name already exists',
            'url.required' => 'Url is required',
            'url.string' => 'invalid type',
            'url.unique' => 'Url already exists',
        ]);

        $social->update([
            'name' => $request->name,
            'url' => $request->url,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('manage.cms.view')->with('success', 'updated');
    }

    public function social_destroy($id) {
        $social = Social::find(Crypt::decryptString($id));
        if (!$social) return back()->withErrors('cannot find this social media');
        $social->delete();
        return redirect()->route('manage.cms.view')->with('success', 'deleted');
    }
}
