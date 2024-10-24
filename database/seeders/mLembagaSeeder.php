<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mLembagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lembaga = [
            ['name' => 'PT'],
            ['name' => 'CV'],
            ['name' => 'Koperasi'],
            ['name' => 'Kelompok'],
            ['name' => 'UD'],
            ['name' => 'BUMDes'],
            ['name' => 'BUMD'],
        ];

        DB::table('m_lembaga')->insert($lembaga);
    }
}
