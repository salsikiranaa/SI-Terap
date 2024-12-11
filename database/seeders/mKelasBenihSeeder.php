<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mKelasBenihSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas_benih = [
            ['name' => 'FS (Breeder Seed)'],
            ['name' => 'ES (Foundation Seed)'],
            ['name' => 'BS (Stock Seed)'],
            ['name' => 'SS (Extention Seed)'],
        ];
        DB::table('m_kelas_benih')->insert($kelas_benih);
    }
}
