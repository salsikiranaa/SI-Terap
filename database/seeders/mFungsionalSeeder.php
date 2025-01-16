<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mFungsionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fungsional = [
            ['name' => 'Utama'],
            ['name' => 'Pratama'],
            ['name' => 'Madya'],
            ['name' => 'Muda'],
        ];

        DB::table('m_fungsional')->insert($fungsional);
    }
}
