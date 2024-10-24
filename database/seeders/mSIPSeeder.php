<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mSIPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sip = [
            ['name' => 'TP'],
            ['name' => 'Horti'],
            ['name' => 'Bun'],
            ['name' => 'Nak'],
            ['name' => 'Agroinput'],
            ['name' => 'Paspa'],
        ];

        DB::table('m_sip')->insert($sip);
    }
}
