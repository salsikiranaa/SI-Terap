<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mKelompokStandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelompok_standard = [
            ['name' => 'Produk'],
            ['name' => 'Sistem'],
            ['name' => 'Proses'],
            ['name' => 'SDM'],
            ['name' => 'Jasa'],
        ];

        DB::table('m_kelompok_standard')->insert($kelompok_standard);
    }
}
