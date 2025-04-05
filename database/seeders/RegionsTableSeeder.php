<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionsTableSeeder extends Seeder
{
    public function run()
    {
        $regions = [
            ['code' => '01', 'name' => 'Metro Manila'],
            ['code' => '02', 'name' => 'Mindanao'],
            ['code' => '03', 'name' => 'North Luzon'],
            ['code' => '04', 'name' => 'South Luzon'],
            ['code' => '05', 'name' => 'Visayas'],
        ];

        foreach ($regions as $region) {
            Region::firstOrCreate(
                ['code' => $region['code']],
                ['name' => $region['name']]
            );
        }
    }
}
