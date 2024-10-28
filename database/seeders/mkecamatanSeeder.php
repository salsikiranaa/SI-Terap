<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mkecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_path = storage_path('/app/data_region/districts.csv');
        $csv_file = fopen($file_path, 'r');
        $bypass = fgetcsv($csv_file); // bypass first row
        
        $kecamatan = [];
        while (($row = fgetcsv($csv_file)) !== false) {
            $kecamatan[] = [
                'id' => $row[0],
                'kabupaten_id' => $row[1],
                'name' => $row[2],
            ];
        }
        fclose($csv_file);

        DB::table('m_kecamatan')->insert($kecamatan);
    }
}
