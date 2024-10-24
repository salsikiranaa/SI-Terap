<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mSasaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sasaran = [
            ['name' => 'Petani'],
            ['name' => 'UMKM'],
            ['name' => 'Pelaku Usaha'],
            ['name' => 'koperasi'],
            ['name' => 'BUMDes/BUMD'],
        ];

        DB::table('m_sasaran')->insert($sasaran);
    }
}
