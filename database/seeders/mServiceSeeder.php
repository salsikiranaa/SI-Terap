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
            ['id' => 1, 'name' => 'Kinerja Kegiatan', 'is_locked' => false],
            ['id' => 2, 'name' => 'Laboratorium Pengujian', 'is_locked' => false],
            ['id' => 3, 'name' => 'Perbenihan', 'is_locked' => false],
            ['id' => 4, 'name' => 'IP2SIP', 'is_locked' => false],
            ['id' => 5, 'name' => 'Direktori SDM Penyluh', 'is_locked' => false],
        ];

        DB::table('m_service')->insert($service);
    }
}
