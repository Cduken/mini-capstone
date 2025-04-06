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

            // All Bohol Cities and Municipalities
            ['code' => '050201', 'province_code' => '0502', 'name' => 'Tagbilaran City', 'zip_code' => '6300'],
            ['code' => '050202', 'province_code' => '0502', 'name' => 'Alburquerque', 'zip_code' => '6302'],
            ['code' => '050203', 'province_code' => '0502', 'name' => 'Alicia', 'zip_code' => '6314'],
            ['code' => '050204', 'province_code' => '0502', 'name' => 'Anda', 'zip_code' => '6311'],
            ['code' => '050205', 'province_code' => '0502', 'name' => 'Antequera', 'zip_code' => '6335'],
            ['code' => '050206', 'province_code' => '0502', 'name' => 'Baclayon', 'zip_code' => '6301'],
            ['code' => '050207', 'province_code' => '0502', 'name' => 'Balilihan', 'zip_code' => '6342'],
            ['code' => '050208', 'province_code' => '0502', 'name' => 'Batuan', 'zip_code' => '6318'],
            ['code' => '050209', 'province_code' => '0502', 'name' => 'Bien Unido', 'zip_code' => '6326'],
            ['code' => '050210', 'province_code' => '0502', 'name' => 'Bilar', 'zip_code' => '6317'],
            ['code' => '050211', 'province_code' => '0502', 'name' => 'Buenavista', 'zip_code' => '6333'],
            ['code' => '050212', 'province_code' => '0502', 'name' => 'Calape', 'zip_code' => '6328'],
            ['code' => '050213', 'province_code' => '0502', 'name' => 'Candijay', 'zip_code' => '6312'],
            ['code' => '050214', 'province_code' => '0502', 'name' => 'Carmen', 'zip_code' => '6319'],
            ['code' => '050215', 'province_code' => '0502', 'name' => 'Catigbian', 'zip_code' => '6343'],
            ['code' => '050216', 'province_code' => '0502', 'name' => 'Clarin', 'zip_code' => '6330'],
            ['code' => '050217', 'province_code' => '0502', 'name' => 'Corella', 'zip_code' => '6337'],
            ['code' => '050218', 'province_code' => '0502', 'name' => 'Cortes', 'zip_code' => '6341'],
            ['code' => '050219', 'province_code' => '0502', 'name' => 'Dagohoy', 'zip_code' => '6322'],
            ['code' => '050220', 'province_code' => '0502', 'name' => 'Danao', 'zip_code' => '6344'],
            ['code' => '050221', 'province_code' => '0502', 'name' => 'Dauis', 'zip_code' => '6339'],
            ['code' => '050222', 'province_code' => '0502', 'name' => 'Dimiao', 'zip_code' => '6305'],
            ['code' => '050223', 'province_code' => '0502', 'name' => 'Duero', 'zip_code' => '6309'],
            ['code' => '050224', 'province_code' => '0502', 'name' => 'Garcia Hernandez', 'zip_code' => '6307'],
            ['code' => '050225', 'province_code' => '0502', 'name' => 'Getafe', 'zip_code' => '6334'],
            ['code' => '050226', 'province_code' => '0502', 'name' => 'Guindulman', 'zip_code' => '6310'],
            ['code' => '050227', 'province_code' => '0502', 'name' => 'Inabanga', 'zip_code' => '6332'],
            ['code' => '050228', 'province_code' => '0502', 'name' => 'Jagna', 'zip_code' => '6308'],
            ['code' => '050229', 'province_code' => '0502', 'name' => 'Jetafe', 'zip_code' => '6334'],
            ['code' => '050230', 'province_code' => '0502', 'name' => 'Lila', 'zip_code' => '6304'],
            ['code' => '050231', 'province_code' => '0502', 'name' => 'Loay', 'zip_code' => '6303'],
            ['code' => '050232', 'province_code' => '0502', 'name' => 'Loboc', 'zip_code' => '6316'],
            ['code' => '050233', 'province_code' => '0502', 'name' => 'Loon', 'zip_code' => '6327'],
            ['code' => '050234', 'province_code' => '0502', 'name' => 'Mabini', 'zip_code' => '6313'],
            ['code' => '050235', 'province_code' => '0502', 'name' => 'Maribojoc', 'zip_code' => '6336'],
            ['code' => '050236', 'province_code' => '0502', 'name' => 'Panglao', 'zip_code' => '6340'],
            ['code' => '050237', 'province_code' => '0502', 'name' => 'Pilar', 'zip_code' => '6321'],
            ['code' => '050238', 'province_code' => '0502', 'name' => 'President Carlos P. Garcia', 'zip_code' => '6346'],
            ['code' => '050239', 'province_code' => '0502', 'name' => 'Sagbayan', 'zip_code' => '6331'],
            ['code' => '050240', 'province_code' => '0502', 'name' => 'San Isidro', 'zip_code' => '6325'],
            ['code' => '050241', 'province_code' => '0502', 'name' => 'San Miguel', 'zip_code' => '6323'],
            ['code' => '050242', 'province_code' => '0502', 'name' => 'Sevilla', 'zip_code' => '6347'],
            ['code' => '050243', 'province_code' => '0502', 'name' => 'Sierra Bullones', 'zip_code' => '6320'],
            ['code' => '050244', 'province_code' => '0502', 'name' => 'Sikatuna', 'zip_code' => '6338'],
            ['code' => '050245', 'province_code' => '0502', 'name' => 'Talibon', 'zip_code' => '6325'],
            ['code' => '050246', 'province_code' => '0502', 'name' => 'Trinidad', 'zip_code' => '6324'],
            ['code' => '050247', 'province_code' => '0502', 'name' => 'Tubigon', 'zip_code' => '6329'],
            ['code' => '050248', 'province_code' => '0502', 'name' => 'Ubay', 'zip_code' => '6315'],
            ['code' => '050249', 'province_code' => '0502', 'name' => 'Valencia', 'zip_code' => '6306'],

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
