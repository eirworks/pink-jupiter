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
            'menus' => collect($this->menus())->filter(function($value) {
                $menuValue = collect($value);
                if ($menuValue->get('superadmin', false)) {
                    return true;
                }
                return $menuValue->get('auth', true);
            }),
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
                'auth' => true,
            ],
            [
                'name' => "Layanan",
                'hint' => "Kelola layanan dan sub layanan",
                'url' => route('admin.categories.index'),
                'icon' => asset('images/icons/tools.png'),
                'auth' => true,
            ],
            [
                'name' => "Kota dan Provinsi",
                'hint' => "Kelola provinsi dan kota-kotanya",
                'url' => route('admin.provinces.all'),
                'icon' => asset('images/icons/city.png'),
                'auth' => true,
            ],
            [
                'name' => "Admin",
                'hint' => "Kelola admin",
                'url' => route('admin.admin.index'),
                'icon' => asset('images/icons/shield-account.png'),
                'auth' => auth()->user()->admin_manager ? true : false,
            ],
            [
                'name' => "Transaksi",
                'hint' => "Lihat riwayat transaksi",
                'url' => route('admin.transactions.index'),
                'icon' => asset('images/icons/account-cash.png'),
                'auth' => true,
            ],
            [
                'name' => "Deposit",
                'hint' => "Kelola permintaan konfirmasi deposit",
                'url' => route('admin.deposits.index'),
                'icon' => asset('images/icons/wallet.png'),
                'auth' => true,
            ],
            [
                'name' => "Artikel",
                'hint' => "Kelola artikel untuk berita atau halaman",
                'url' => route('admin.posts.index'),
                'icon' => asset('images/icons/newspaper.png'),
                'auth' => true,
            ],
            [
                'name' => "Pengaturan",
                'hint' => "Pengaturan situs",
                'url' => route('admin.settings.edit'),
                'icon' => asset('images/icons/settings.png'),
                'auth' => true,
            ],
        ];
    }
}
