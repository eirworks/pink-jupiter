<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Province;
use App\Service;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $provinces = Province::get();

        $categories = Category::where('parent_id', 0)->with(['children'])->get();

        $subCategories = Category::where('parent_id', '>', 0)->get()->map(function($subCat) {
            return [
                'name' => $subCat->name,
                'url' => route('listing.index', ['category_id' => $subCat->id]),
            ];
        });

        $ads = Service::orderBy('id', 'desc')
            ->when($request->filled('city_id'), function ($query) use($request) {
                $query->where('city_id', $request->input('city_id'));
            })
            ->when($request->filled('category_id'), function ($query) use($request) {
                $query->where('category_id', $request->input('category_id'));
            })
            ->whereHas('user', function($query) {
                $query->where('balance', '>', 0);
            })
            ->where('activated', true)
            ->with(['user', 'district', 'district.city', 'district.city.province'])
            ->paginate();

        $cities = City::get();

        return view('home', [
            'provinces' => $provinces,
            'cities' => $cities,
            'categories' => $categories,
            'subCategoriesJson' => json_encode($subCategories),
            'ads' => $ads,
            'citiesJson' => json_encode($cities->map(function($city) {
                return [
                    'id' => $city->id,
                    'name' => $city->name,
                ];
            }))
        ]);
    }
}
