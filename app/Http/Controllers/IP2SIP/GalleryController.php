<?php

namespace App\Http\Controllers\IP2SIP; // Perhatikan perbedaan di sini (SIP bukan SP)

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::paginate(25);
        return view('lp2tp.galeri', [
            'gallery' => $gallery
        ]);
    }
}
