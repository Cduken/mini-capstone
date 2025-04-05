<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barangay;
use App\Models\City;

class BarangaysTableSeeder extends Seeder
{
    public function run()
    {
        if (City::count() === 0) {
            $this->command->error('No cities found! Run CitiesTableSeeder first.');
            return;
        }

        $barangays = [
            // Tagbilaran City, Bohol (050201)
            ['code' => '05020101', 'city_code' => '050201', 'name' => 'Poblacion I'],
            ['code' => '05020102', 'city_code' => '050201', 'name' => 'Poblacion II'],
            ['code' => '05020103', 'city_code' => '050201', 'name' => 'Poblacion III'],
            ['code' => '05020104', 'city_code' => '050201', 'name' => 'Cogon'],
            ['code' => '05020105', 'city_code' => '050201', 'name' => 'Taloto'],
            ['code' => '05020106', 'city_code' => '050201', 'name' => 'Tiptip'],
            ['code' => '05020107', 'city_code' => '050201', 'name' => 'Bool'],
            ['code' => '05020108', 'city_code' => '050201', 'name' => 'Cabawan'],
            ['code' => '05020109', 'city_code' => '050201', 'name' => 'Manga'],
            ['code' => '05020110', 'city_code' => '050201', 'name' => 'Ubujan'],

            // Dauis, Bohol (050202)
            ['code' => '05020201', 'city_code' => '050202', 'name' => 'Poblacion'],
            ['code' => '05020202', 'city_code' => '050202', 'name' => 'Mayacabac'],
            ['code' => '05020203', 'city_code' => '050202', 'name' => 'Songculan'],
            ['code' => '05020204', 'city_code' => '050202', 'name' => 'Totolan'],
            ['code' => '05020205', 'city_code' => '050202', 'name' => 'Biking'],

            // Panglao, Bohol (050203)
            ['code' => '05020301', 'city_code' => '050203', 'name' => 'Poblacion'],
            ['code' => '05020302', 'city_code' => '050203', 'name' => 'Danao'],
            ['code' => '05020303', 'city_code' => '050203', 'name' => 'Lourdes'],
            ['code' => '05020304', 'city_code' => '050203', 'name' => 'Tawala'],
            ['code' => '05020305', 'city_code' => '050203', 'name' => 'Bil-isan'],

            // Baclayon, Bohol (050204)
            ['code' => '05020401', 'city_code' => '050204', 'name' => 'Poblacion'],
            ['code' => '05020402', 'city_code' => '050204', 'name' => 'Laya'],
            ['code' => '05020403', 'city_code' => '050204', 'name' => 'Guadalupe'],
            ['code' => '05020404', 'city_code' => '050204', 'name' => 'Santa Rosa'],

            // Corella, Bohol (050205)
            ['code' => '05020501', 'city_code' => '050205', 'name' => 'Poblacion'],
            ['code' => '05020502', 'city_code' => '050205', 'name' => 'Anislag'],
            ['code' => '05020503', 'city_code' => '050205', 'name' => 'Canangca-an'],

            // Tubigon, Bohol (050206) - Added all 34 barangays
            ['code' => '05020601', 'city_code' => '050206', 'name' => 'Poblacion I'],
            ['code' => '05020602', 'city_code' => '050206', 'name' => 'Poblacion II'],
            ['code' => '05020603', 'city_code' => '050206', 'name' => 'Poblacion III'],
            ['code' => '05020604', 'city_code' => '050206', 'name' => 'Bagongbanwa'],
            ['code' => '05020605', 'city_code' => '050206', 'name' => 'Bunacan'],
            ['code' => '05020606', 'city_code' => '050206', 'name' => 'Banlasan'],
            ['code' => '05020607', 'city_code' => '050206', 'name' => 'Batasan (Batasan Island)'],
            ['code' => '05020608', 'city_code' => '050206', 'name' => 'Bilangbilangan'],
            ['code' => '05020609', 'city_code' => '050206', 'name' => 'Bosongon'],
            ['code' => '05020610', 'city_code' => '050206', 'name' => 'Buenavista'],
            ['code' => '05020611', 'city_code' => '050206', 'name' => 'Cayap Norte'],
            ['code' => '05020612', 'city_code' => '050206', 'name' => 'Cayap Sur'],
            ['code' => '05020613', 'city_code' => '050206', 'name' => 'Centro'],
            ['code' => '05020614', 'city_code' => '050206', 'name' => 'Genonocan'],
            ['code' => '05020615', 'city_code' => '050206', 'name' => 'Guiwanon'],
            ['code' => '05020616', 'city_code' => '050206', 'name' => 'Ilijan'],
            ['code' => '05020617', 'city_code' => '050206', 'name' => 'Imelda'],
            ['code' => '05020618', 'city_code' => '050206', 'name' => 'Panadtaran'],
            ['code' => '05020619', 'city_code' => '050206', 'name' => 'Panaytayon'],
            ['code' => '05020620', 'city_code' => '050206', 'name' => 'Pandan'],
            ['code' => '05020621', 'city_code' => '050206', 'name' => 'Pinayagan Norte'],
            ['code' => '05020622', 'city_code' => '050206', 'name' => 'Pinayagan Sur'],
            ['code' => '05020623', 'city_code' => '050206', 'name' => 'Pooc Occidental'],
            ['code' => '05020624', 'city_code' => '050206', 'name' => 'Pooc Oriental'],
            ['code' => '05020625', 'city_code' => '050206', 'name' => 'Potohan'],
            ['code' => '05020626', 'city_code' => '050206', 'name' => 'Talenceras'],
            ['code' => '05020627', 'city_code' => '050206', 'name' => 'Tan-awan'],
            ['code' => '05020628', 'city_code' => '050206', 'name' => 'Tinangnan'],
            ['code' => '05020629', 'city_code' => '050206', 'name' => 'Ubay Island'],
            ['code' => '05020630', 'city_code' => '050206', 'name' => 'Ubojan'],
            ['code' => '05020631', 'city_code' => '050206', 'name' => 'Villanueva'],
            ['code' => '05020632', 'city_code' => '050206', 'name' => 'Villaflor'],
            ['code' => '05020633', 'city_code' => '050206', 'name' => 'San Isidro'],
            ['code' => '05020634', 'city_code' => '050206', 'name' => 'San Vicente'],

            // Cebu City (050101)
            ['code' => '05010101', 'city_code' => '050101', 'name' => 'Adlaon'],
            ['code' => '05010102', 'city_code' => '050101', 'name' => 'Agsungot'],
            ['code' => '05010103', 'city_code' => '050101', 'name' => 'Apas'],

            // Manila (010101)
            ['code' => '01010101', 'city_code' => '010101', 'name' => 'Binondo'],
            ['code' => '01010102', 'city_code' => '010101', 'name' => 'Ermita'],
            ['code' => '01010103', 'city_code' => '010101', 'name' => 'Intramuros'],
        ];

        foreach ($barangays as $barangay) {
            if (!City::where('code', $barangay['city_code'])->exists()) {
                $this->command->error("Missing city: {$barangay['city_code']}");
                continue;
            }

            Barangay::firstOrCreate(
                ['code' => $barangay['code']],
                [
                    'city_code' => $barangay['city_code'],
                    'name' => $barangay['name']
                ]
            );
        }
    }
}
