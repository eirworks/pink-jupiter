<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Province;
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

        return view('home', [
            'provinces' => $provinces,
            'cities' => $cities,
            'categories' => $categories,
        ]);
    }
}
