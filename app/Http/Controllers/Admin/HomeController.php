<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthIsAdmin;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(AuthIsAdmin::class);
    }

    public function index(Request $request)
    {
        return view('admin.home', [
            'menus' => $this->menus(),
        ]);
    }

    private function menus()
    {
        return [
            [
                'name' => "Mitra",
                'hint' => "Kelola Mitra termasuk Mitra yang masih pending",
                'url' => route('admin.partners.index'),
                'icon' => asset('images/icons/account-group.png'),
            ],
            [
                'name' => "Layanan",
                'hint' => "Kelola layanan dan sub layanan",
                'url' => route('admin.categories.index'),
                'icon' => asset('images/icons/tools.png'),
            ],
            [
                'name' => "Kota dan Provinsi",
                'hint' => "Kelola provinsi dan kota-kotanya",
                'url' => route('admin.provinces.all'),
                'icon' => asset('images/icons/city.png'),
            ],
        ];
    }
}
