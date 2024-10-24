<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('password'), 'role_id' => 1],
        ];

        DB::table('users')->insert($user);
    }
}
