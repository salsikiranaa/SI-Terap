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
            ['image' => 'kp_bandabuat.jpg', 'title' => 'KP.Bandabuat'],
            ['image' => 'kp_cipaku.PNG', 'title' => 'KP.Cipaku'],
            ['image' => 'kp_gayo.jpg', 'title' => 'KP.Gayo'],
            ['image' => 'kp_gugur.PNG', 'title' => 'KP.Gugur'],
            ['image' => 'kp_karangagung.jpg', 'title' => 'KP.Karang Agung'],
            ['image' => 'kp_kayuagung.jpg', 'title' => 'KP.Kayu Agung'],
            ['image' => 'kp_pasarmiring.jpg', 'title' => 'KP.Pasar Miring'],
            ['image' => 'kp_sitiung.jpg', 'title' => 'KP.Sitiung'],
        ];

        // Kirim data ke view
        return view('lp2tp.galeri', compact('galleries'));
    }
}
