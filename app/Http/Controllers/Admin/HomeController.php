<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthIsAdmin;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(AuthIsAdmin::class);
    }

    public function index(Request $request)
    {
        $stats = [
            'visitors' => User::sum('visitors'),
            'users' => User::partner()->count(),
        ];

        return view('admin.home', [
            'menus' => $this->menus(),
            'stats' => $stats,
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
            [
                'name' => "Admin",
                'hint' => "Kelola admin",
                'url' => route('admin.admin.index'),
                'icon' => asset('images/icons/shield-account.png'),
            ],
            [
                'name' => "Pengaturan",
                'hint' => "Pengaturan situs",
                'url' => route('admin.settings.edit'),
                'icon' => asset('images/icons/settings.png'),
            ],
        ];
    }
}
