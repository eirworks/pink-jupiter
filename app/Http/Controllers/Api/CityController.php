<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Http\Controllers\Controller;
use App\Province;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function cities()
    {
        $cities = City::select('id', 'name')->get();
        return response()->json($cities);
    }

    public function provinces()
    {
        $provinces = Province::select('id','name')->with(['cities:id,name,province_id'])
            ->get();

        return response()->json($provinces);
    }
}
