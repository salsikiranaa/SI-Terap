<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mKomoditasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $komoditas = [
            ['name' => 'Padi'],
            ['name' => 'Jagung'],
            ['name' => 'Kacang Kedelai'],
            ['name' => 'Ayam KUB'],
            ['name' => 'Domba'],
            ['name' => 'Kopi'],
            ['name' => 'Sapi'],
            ['name' => 'Bebek Hibrida'],
            ['name' => 'Bawang Putih'],
            ['name' => 'Bawang Merah'],
            ['name' => 'Cabai'],
            ['name' => 'Kelapa Sawit'],
            ['name' => 'Krisan'],
            ['name' => 'Kacang Tanah'],
            ['name' => 'Ubi Jalar'],
            ['name' => 'Ubi Kayu'],
        ];

        DB::table('m_komoditas')->insert($komoditas);
    }
}
