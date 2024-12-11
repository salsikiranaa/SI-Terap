<?php

namespace App\Http\Controllers\Kinerja;

use App\Http\Controllers\Controller; // Tambahkan ini
use Illuminate\Http\Request;

class provinceDiseminasiController extends Controller
{
    public function show($province)
    {
        // Mapping hc-key ke nama provinsi
        $provinceNames = [
            'id-ac' => 'Aceh',
            'id-jt' => 'Jawa Tengah',
            'id-be' => 'Bengkulu',
            'id-bt' => 'Banten',
            'id-kb' => 'Kalimantan Barat',
            'id-bb' => 'Bangka Belitung',
            'id-ba' => 'Bali',
            'id-ji' => 'Jawa Timur',
            'id-ks' => 'Kalimantan Selatan',
            'id-nt' => 'Nusa Tenggara Timur',
            'id-se' => 'Sulawesi Selatan',
            'id-kr' => 'Kepulauan Riau',
            'id-ib' => 'Papua Barat',
            'id-su' => 'Sumatra Utara',
            'id-ri' => 'Riau',
            'id-sw' => 'Sulawesi Utara',
            'id-ku' => 'Kalimantan Utara',
            'id-la' => 'Maluku Utara',
            'id-sb' => 'Sumatera Barat',
            'id-ma' => 'Maluku',
            'id-nb' => 'Nusa Tenggara Barat',
            'id-sg' => 'Sulawesi Tenggara',
            'id-st' => 'Sulawesi Tengah',
            'id-pa' => 'Papua',
            'id-jr' => 'Jawa Barat',
            'id-ki' => 'Kalimantan Timur',
            'id-1024' => 'Lampung',
            'id-jk' => 'Jakarta',
            'id-go' => 'Gorontalo',
            'id-yo' => 'Yogyakarta',
            'id-sl' => 'Sumatera Selatan',
            'id-sr' => 'Sulawesi Barat',
            'id-ja' => 'Jambi',
            'id-kt' => 'Kalimantan Tengah',
        ];

        // Cari nama provinsi berdasarkan hc-key
        $provinceName = $provinceNames[$province] ?? 'Provinsi Tidak Dikenal';

        // Kirim data ke view
        return view('kinerja.diseminasi.provinsiDiseminasi', compact('province', 'provinceName'));
    }
}
