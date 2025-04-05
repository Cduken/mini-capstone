<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Province;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        if (Province::count() === 0) {
            $this->command->error('No provinces found! Run ProvincesTableSeeder first.');
            return;
        }

        $cities = [
            // Metro Manila
            ['code' => '010101', 'province_code' => '0101', 'name' => 'City of Manila', 'zip_code' => '1000'],
            ['code' => '010201', 'province_code' => '0102', 'name' => 'Quezon City', 'zip_code' => '1100'],
            ['code' => '010301', 'province_code' => '0103', 'name' => 'Pasig City', 'zip_code' => '1600'],
            ['code' => '010401', 'province_code' => '0104', 'name' => 'Makati City', 'zip_code' => '1200'],
            ['code' => '010501', 'province_code' => '0105', 'name' => 'Taguig City', 'zip_code' => '1630'],

            // Mindanao
            ['code' => '020101', 'province_code' => '0201', 'name' => 'Davao City', 'zip_code' => '8000'],
            ['code' => '020201', 'province_code' => '0202', 'name' => 'Cagayan de Oro City', 'zip_code' => '9000'],
            ['code' => '020301', 'province_code' => '0203', 'name' => 'Malaybalay City', 'zip_code' => '8700'],
            ['code' => '020401', 'province_code' => '0204', 'name' => 'Butuan City', 'zip_code' => '8600'],
            ['code' => '020501', 'province_code' => '0205', 'name' => 'Zamboanga City', 'zip_code' => '7000'],

            // North Luzon
            ['code' => '030101', 'province_code' => '0301', 'name' => 'Dagupan City', 'zip_code' => '2400'],
            ['code' => '030201', 'province_code' => '0302', 'name' => 'Baguio City', 'zip_code' => '2600'],
            ['code' => '030301', 'province_code' => '0303', 'name' => 'Bayombong', 'zip_code' => '3700'],
            ['code' => '030401', 'province_code' => '0304', 'name' => 'Laoag City', 'zip_code' => '2900'],
            ['code' => '030501', 'province_code' => '0305', 'name' => 'Ilagan City', 'zip_code' => '3300'],

            // South Luzon
            ['code' => '040101', 'province_code' => '0401', 'name' => 'Batangas City', 'zip_code' => '4200'],
            ['code' => '040201', 'province_code' => '0402', 'name' => 'Imus City', 'zip_code' => '4103'],
            ['code' => '040301', 'province_code' => '0403', 'name' => 'Santa Rosa City', 'zip_code' => '4026'],
            ['code' => '040401', 'province_code' => '0404', 'name' => 'Lucena City', 'zip_code' => '4301'],
            ['code' => '040501', 'province_code' => '0405', 'name' => 'Antipolo City', 'zip_code' => '1870'],

            // Visayas - Focus on Bohol
            ['code' => '050101', 'province_code' => '0501', 'name' => 'Cebu City', 'zip_code' => '6000'],
            ['code' => '050102', 'province_code' => '0501', 'name' => 'Mandaue City', 'zip_code' => '6014'],
            ['code' => '050103', 'province_code' => '0501', 'name' => 'Lapu-Lapu City', 'zip_code' => '6015'],

            // Bohol Cities and Municipalities
            ['code' => '050201', 'province_code' => '0502', 'name' => 'Tagbilaran City', 'zip_code' => '6300'],
            ['code' => '050202', 'province_code' => '0502', 'name' => 'Dauis', 'zip_code' => '6339'],
            ['code' => '050203', 'province_code' => '0502', 'name' => 'Panglao', 'zip_code' => '6340'],
            ['code' => '050204', 'province_code' => '0502', 'name' => 'Baclayon', 'zip_code' => '6301'],
            ['code' => '050205', 'province_code' => '0502', 'name' => 'Corella', 'zip_code' => '6337'],
            ['code' => '050206', 'province_code' => '0502', 'name' => 'Tubigon', 'zip_code' => '6329'],
            ['code' => '050207', 'province_code' => '0502', 'name' => 'Carmen', 'zip_code' => '6319'],

            // Other Visayas provinces
            ['code' => '050301', 'province_code' => '0503', 'name' => 'Dumaguete City', 'zip_code' => '6200'],
            ['code' => '050401', 'province_code' => '0504', 'name' => 'Tacloban City', 'zip_code' => '6500'],
            ['code' => '050501', 'province_code' => '0505', 'name' => 'Catbalogan City', 'zip_code' => '6700'],
        ];

        foreach ($cities as $city) {
            if (!Province::where('code', $city['province_code'])->exists()) {
                $this->command->error("Missing province: {$city['province_code']}");
                continue;
            }

            City::firstOrCreate(
                ['code' => $city['code']],
                [
                    'province_code' => $city['province_code'],
                    'name' => $city['name'],
                    'zip_code' => $city['zip_code']
                ]
            );
        }
    }
}
