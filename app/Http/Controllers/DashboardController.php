<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mProvinsi; // Pastikan model Provinsi ada

class DashboardController extends Controller
{
    public function beranda()
    {
        // Ambil data dari tabel m_provinsi
        $provinsiData = mProvinsi::all();

        if ($provinsiData->isEmpty()) {
            return "Data provinsi tidak ditemukan.";
        }

        // Kirim data ke view
        return view('kinerja.identifikasi.beranda', compact('provinsiData')); // Pastikan nama view ini sesuai
    }
}

