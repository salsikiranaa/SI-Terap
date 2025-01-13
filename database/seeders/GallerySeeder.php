<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            ['image_url' => '/storage/gallery/kp_bandabuat.jpg', 'title' => 'KP.Bandabuat', 'description' => 'Lorem Ipsum'],
            ['image_url' => '/storage/gallery/kp_cipaku.PNG', 'title' => 'KP.Cipaku', 'description' => 'Lorem Ipsum'],
            ['image_url' => '/storage/gallery/kp_gayo.jpg', 'title' => 'KP.Gayo', 'description' => 'Lorem Ipsum'],
            ['image_url' => '/storage/gallery/kp_gugur.PNG', 'title' => 'KP.Gugur', 'description' => 'Lorem Ipsum'],
            ['image_url' => '/storage/gallery/kp_karangagung.jpg', 'title' => 'KP.Karang Agung', 'description' => 'Lorem Ipsum'],
            ['image_url' => '/storage/gallery/kp_kayuagung.jpg', 'title' => 'KP.Kayu Agung', 'description' => 'Lorem Ipsum'],
            ['image_url' => '/storage/gallery/kp_pasarmiring.jpg', 'title' => 'KP.Pasar Miring', 'description' => 'Lorem Ipsum'],
            ['image_url' => '/storage/gallery/kp_sitiung.jpg', 'title' => 'KP.Sitiung', 'description' => 'Lorem Ipsum'],
        ];

        DB::table('gallery')->insert($galleries);
    }
}
