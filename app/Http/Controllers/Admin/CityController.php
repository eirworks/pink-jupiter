<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function create(Request $request)
    {
        $city = new City();

        return view('admin.cities.form', [
            'city' => $city,
        ]);
    }

    public function edit(Request $request, City $city)
    {
        return view('admin.cities.form', [
            'city' => $city,
        ]);
    }

    public function store(Request $request)
    {
        $city = new City();
        $city->name = $request->input('name');
        $city->province_id = $request->input('province_id');
        $city->save();

        return redirect()->route('admin.provinces.all')
            ->with('success', 'Kota telah disimpan!');
    }

    public function update(Request $request, City $city)
    {
        $city->name = $request->input('name');
        $city->save();

        return redirect()->route('admin.provinces.all')
            ->with('success', 'Kota telah disimpan!');
    }

    public function delete(City $city)
    {
        $city->delete();

        return redirect()->route('admin.provinces.all')
            ->with('success', 'Kota telah dihapus!');
    }
}
