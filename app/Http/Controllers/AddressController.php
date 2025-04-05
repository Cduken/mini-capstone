<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Province;
use App\Models\City;
use App\Models\Barangay;

class AddressController extends Controller
{
    public function getRegions()
    {
        $regions = Region::orderBy('name')->get();
        return response()->json($regions);
    }

    public function getProvinces(Request $request)
    {
        $regionCode = $request->query('region_code');
        $provinces = Province::where('region_code', $regionCode)
            ->orderBy('name')
            ->get();

        return response()->json($provinces);
    }

    public function getCities(Request $request)
    {
        $provinceCode = $request->query('province_code');
        $cities = City::where('province_code', $provinceCode)
            ->orderBy('name')
            ->get();

        return response()->json($cities);
    }

    public function getBarangays(Request $request)
    {
        $cityCode = $request->query('city_code');
        $barangays = Barangay::where('city_code', $cityCode)
            ->orderBy('name')
            ->get();

        return response()->json($barangays);
    }
}
