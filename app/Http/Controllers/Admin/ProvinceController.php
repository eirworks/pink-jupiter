<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index(Request $request)
    {
        $provinces = Province::with(['cities'])
            ->withCount(['cities'])
            ->get();

        return view('admin.data.provinces.index', [
            'provinces' => $provinces,
        ]);
    }

    public function create(Request $request)
    {
        $province = new Province();

        return view('admin.provinces.form', [
            'province' => $province,
        ]);
    }

    public function edit(Request $request, Province $province)
    {
        return view('admin.provinces.form', [
            'province' => $province,
        ]);
    }

    public function store(Request $request)
    {
        $province = new Province();

        $province->name = $request->input('name');
        $province->save();

        return redirect()->route('admin.provinces.all')
            ->with('success', "Provinsi telah disimpan!");
    }

    public function update(Request $request, Province $province)
    {
        $province->name = $request->input('name');
        $province->save();

        return redirect()->route('admin.provinces.all')
            ->with('success', "Provinsi telah disimpan!");
    }

    public function delete(Province $province)
    {
        $province->cities()->delete();
        $province->delete();

        return redirect()->route('admin.provinces.all')
            ->with('success', "Provinsi dan kota-kotanya telah dihapus");
    }
}
