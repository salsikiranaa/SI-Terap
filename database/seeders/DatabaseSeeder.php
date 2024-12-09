<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            mRoleSeeder::class,
            mServiceSeeder::class,
            UserSeeder::class,
            pServiceAccessSeeder::class,

            mProvinsiSeeder::class,
            mKabupatenSeeder::class,
            mKecamatanSeeder::class,
            
            mMetodeSeeder::class,
            mSIPSeeder::class,
            mSasaranSeeder::class,
            mJenisStandardSeeder::class,
            mKelompokStandardSeeder::class,
            mLembagaSeeder::class,
            mBSIPSeeder::class,
            mIP2SIPSeeder::class,

            CMSSeeder::class,
            SocialSeeder::class,
        ]);
    }
}
