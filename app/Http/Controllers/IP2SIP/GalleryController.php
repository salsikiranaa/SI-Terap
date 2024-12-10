<?php

namespace App\Http\Controllers\IP2SIP; // Perhatikan perbedaan di sini (SIP bukan SP)

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Data manual untuk galeri
        $galleries = [
            ['image' => 'infografis_kp_sumbar.png', 'title' => 'KP Sumbar'],
            ['image' => 'kp_bandabuat.jpg', 'title' => 'KP Bandabuat'],
            ['image' => 'kp_cipaku.PNG', 'title' => 'KP Cipaku'],
            ['image' => 'kp_gayo.jpg', 'title' => 'KP Gayo'],
            ['image' => 'kp_gugur.PNG', 'title' => 'KP Gugur'],
        ];

        // Kirim data ke view
        return view('lp2tp.galeri', compact('galleries'));
    }
}
