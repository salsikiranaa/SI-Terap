<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mIP2SIPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_path = storage_path('/app/data_region/ip2sip.csv');
        $csv_file = fopen($file_path, 'r');
        $header = fgetcsv($csv_file); // bypass first row

        $ip2sip = [];
        while (($row = fgetcsv($csv_file)) !== false) {
            $ip2sip[] = [
                'id' => $row[0],
                'bsip_id' => $row[1],
                'name' => $row[2],
            ];
        }
        fclose($csv_file);

        DB::table('m_ip2sip')->insert($ip2sip);
    }
}
