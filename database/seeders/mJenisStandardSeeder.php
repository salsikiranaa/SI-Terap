<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mJenisStandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_standard = [
            ['name' => 'SNI'],
            ['name' => 'GAP'],
            ['name' => 'GHP'],
            ['name' => 'GMP'],
            ['name' => 'PTM'],
        ];

        DB::table('m_jenis_standard')->insert($jenis_standard);
    }
}
