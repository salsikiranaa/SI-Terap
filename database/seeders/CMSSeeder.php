<?php

namespace Database\Seeders;

use App\Models\CMS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CMS::create([
            'institute' => 'BBPSIP',
            'app_name' => 'SI-TERAP',
            'description' => 'Portal Sistem Informasi Terpadu Balai Besar Penerapan Standar Instrumen Pertanian',
            'contact_1' => '(0251) 8531727',
            'contact_2' => '085282828696',
            'email' => 'bbpsip@apps.pertanian.go.id',
            'address' => 'Jl. Tentara Pelajar No.10, RT.04/RW.07, Ciwaringin, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16124',
            'website' => 'https://bsip.pertanian.go.id',
            'updated_by' => 1,
        ]);
    }
}
