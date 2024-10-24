<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pServiceAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $service_access = [
            ['user_id' => 1, 'service_id' => 1],
            ['user_id' => 1, 'service_id' => 2],
            ['user_id' => 1, 'service_id' => 3],
            ['user_id' => 1, 'service_id' => 4],
            ['user_id' => 1, 'service_id' => 5],
        ];

        DB::table('p_service_access')->insert($service_access);
    }
}
