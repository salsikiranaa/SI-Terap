<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Social;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function home() {
        $cms = CMS::first();
        $social = Social::get();
        return view('guest.beranda', [
            'cms' => $cms,
            'social' => $social,
        ]);
    }
}
