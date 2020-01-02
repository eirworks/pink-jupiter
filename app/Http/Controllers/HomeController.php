<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Province;
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

        if ($request->filled('province_id'))
        {
            $cities = City::where('province_id', $request->input('province_id'))
                ->get();
        }
        else {
            $cities = [];
        }

        $categories = Category::where('parent_id', 0)->with(['children'])->get();

        $subCategories = Category::where('parent_id', '>', 0)->get()->map(function($subCat) {
            return [
                'name' => $subCat->name,
                'url' => route('listing.index', ['category_id' => $subCat->id]),
            ];
        });

        $users = User::orderBy('id', 'desc')
            ->where('type', User::TYPE_PARTNER)
            ->where('activated', true)
            ->where('verified', true)
            ->where('balance', '>', 0)
            ->paginate();

        $cities = City::get();

        return view('home', [
            'provinces' => $provinces,
            'cities' => $cities,
            'categories' => $categories,
            'subCategoriesJson' => json_encode($subCategories),
            'users' => $users,
            'citiesJson' => json_encode($cities->map(function($city) {
                return [
                    'id' => $city->id,
                    'name' => $city->name,
                ];
            }))
        ]);
    }
}
