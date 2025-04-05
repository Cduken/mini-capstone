<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Region;

class ProvincesTableSeeder extends Seeder
{
    public function run()
    {
        if (Region::count() === 0) {
            $this->command->error('No regions found! Run RegionsTableSeeder first.');
            return;
        }

        $provinces = [
            // Metro Manila - Region 01
            ['code' => '0101', 'region_code' => '01', 'name' => 'Manila'],
            ['code' => '0102', 'region_code' => '01', 'name' => 'Quezon City'],
            ['code' => '0103', 'region_code' => '01', 'name' => 'Pasig'],
            ['code' => '0104', 'region_code' => '01', 'name' => 'Makati'],
            ['code' => '0105', 'region_code' => '01', 'name' => 'Taguig'],

            // Mindanao - Region 02
            ['code' => '0201', 'region_code' => '02', 'name' => 'Davao del Sur'],
            ['code' => '0202', 'region_code' => '02', 'name' => 'Cagayan de Oro'],
            ['code' => '0203', 'region_code' => '02', 'name' => 'Bukidnon'],
            ['code' => '0204', 'region_code' => '02', 'name' => 'Agusan del Norte'],
            ['code' => '0205', 'region_code' => '02', 'name' => 'Zamboanga del Sur'],

            // North Luzon - Region 03
            ['code' => '0301', 'region_code' => '03', 'name' => 'Pangasinan'],
            ['code' => '0302', 'region_code' => '03', 'name' => 'Benguet'],
            ['code' => '0303', 'region_code' => '03', 'name' => 'Nueva Vizcaya'],
            ['code' => '0304', 'region_code' => '03', 'name' => 'Ilocos Norte'],
            ['code' => '0305', 'region_code' => '03', 'name' => 'Isabela'],

            // South Luzon - Region 04
            ['code' => '0401', 'region_code' => '04', 'name' => 'Batangas'],
            ['code' => '0402', 'region_code' => '04', 'name' => 'Cavite'],
            ['code' => '0403', 'region_code' => '04', 'name' => 'Laguna'],
            ['code' => '0404', 'region_code' => '04', 'name' => 'Quezon'],
            ['code' => '0405', 'region_code' => '04', 'name' => 'Rizal'],

            // Visayas - Region 05
            ['code' => '0501', 'region_code' => '05', 'name' => 'Cebu'],
            ['code' => '0502', 'region_code' => '05', 'name' => 'Bohol'],
            ['code' => '0503', 'region_code' => '05', 'name' => 'Negros Oriental'],
            ['code' => '0504', 'region_code' => '05', 'name' => 'Leyte'],
            ['code' => '0505', 'region_code' => '05', 'name' => 'Samar'],
        ];

        foreach ($provinces as $province) {
            if (!Region::where('code', $province['region_code'])->exists()) {
                $this->command->error("Missing region: {$province['region_code']}");
                continue;
            }

            Province::firstOrCreate(
                ['code' => $province['code']],
                [
                    'region_code' => $province['region_code'],
                    'name' => $province['name']
                ]
            );
        }
    }
}
