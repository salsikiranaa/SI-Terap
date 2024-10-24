<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $service = [
            ['id' => 1, 'name' => 'Kinerja Kegiatan', 'is_locked' => true],
            ['id' => 2, 'name' => 'Laboratorium Pengujian', 'is_locked' => true],
            ['id' => 3, 'name' => 'Pengelolaan Produk', 'is_locked' => true],
            ['id' => 4, 'name' => 'IP2SIP', 'is_locked' => true],
            ['id' => 5, 'name' => 'SDG', 'is_locked' => true],
        ];

        DB::table('m_service')->insert($service);
    }
}
