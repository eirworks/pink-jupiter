<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Province;
use App\Ad;
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
        return view('home', $this->getData($request));
    }

    public function shops(Request $request) {
        return view('home', $this->getData($request, Category::TYPE_SHOP));

    }

    private function getData(Request $request, $type = Category::TYPE_SERVICE) {

        $provinces = Province::with(['cities'])->get();

        $categories = Category::where('parent_id', 0)->where('type', $type)->with(['children'])->get();

        $ads = Ad::orderBy('id', 'desc')
            ->whereHas('category', function($query) use ($type){
                $query->where('type', $type);
            })
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

        return [
            'provinces' => $provinces,
            'categories' => $categories,
            'ads' => $ads,
            'type' => Category::categories()[$type],
        ];
    }
}
