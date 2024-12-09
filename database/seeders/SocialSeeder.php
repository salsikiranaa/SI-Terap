<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $social = [
            ['name' => 'facebook', 'url' => 'https://www.facebook.com/BSIPPenerapan/', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'youtube', 'url' => 'https://www.youtube.com/@bsippenerapan', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'instagram', 'url' => 'https://www.instagram.com/bsippenerapan', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'x-twitter', 'url' => 'https://www.twitter.com/bsippenerapan', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'tiktok', 'url' => 'https://www.tiktok.com/@bsippenerapan', 'created_by' => 1, 'updated_by' => 1],
        ];

        DB::table('social')->insert($social);
    }
}
