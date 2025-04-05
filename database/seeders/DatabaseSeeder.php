<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // DatabaseSeeder.php
    public function run()
    {
        $this->call([
            RegionsTableSeeder::class,
            ProvincesTableSeeder::class,
            CitiesTableSeeder::class,
            BarangaysTableSeeder::class,
            // Add your other seeders here
        ]);
    }
}
