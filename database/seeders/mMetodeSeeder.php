<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mMetodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metode = [
            ['name' => 'Bimbingan Teknis'],
            ['name' => 'Kursus Tani'],
            ['name' => 'Focus Group Discussion'],
            ['name' => 'Sekolah Lapang'],
        ];

        DB::table('m_metode')->insert($metode);
    }
}
