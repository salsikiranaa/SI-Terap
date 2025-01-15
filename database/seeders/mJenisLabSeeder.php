<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mJenisLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_lab = [
            ['name' => 'Laboratorium Pengujian Kimia Tanah dan Mutu Beras'],
            ['name' => 'Laboratorium Analisa Pupuk'],
            ['name' => 'Laboratorium Mutu Pangan'],
            ['name' => 'Laboratorium Uji Sampel Air'],
            ['name' => 'Laboratorium Uji Kesuburan Tanah'],
        ];

        DB::table('m_jenis_lab')->insert($jenis_lab);
    }
}
