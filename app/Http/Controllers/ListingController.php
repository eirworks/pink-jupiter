<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Admin\SettingsController;
use App\Province;
use App\User;
use App\UserTransaction;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('city_id', $request->input('city_id'))
            ->where('type', User::TYPE_PARTNER)
            ->whereHas('categories', function($query) use($request) {
                $query->where('category_id', $request->input('category_id'));
            })
            ->where('activated', true)
            ->where('verified', true)
//            ->where('balance', '>=', 0)
            ->paginate();

        $categories = Category::where('parent_id', 0)->with(['children'])->get();

        $provinces = Province::with(['cities'])->get();

        return view('listing.index', [
            'users' => $users,
            'categories' => $categories,
            'provinces' => $provinces,
        ]);
    }

    public function show(User $user)
    {
        $user->load('city:id,name,province_id');
        $user->load('city.province:id,name');
        $user->load('categories');

        $user->visitors = $user->visitors+1;
        $user->save();

        return view('listing.show', [
            'user' => $user,
        ]);
    }

    public function contact(User $user, $type, Category $category)
    {
        $validTypes = [
            'wa' => "https://wa.me/",
            'tg' => "https://t.me/",
        ];

        if (!in_array($type, array_keys($validTypes)))
        {
            return route('home', ['error' => 11])->with('danger', "Informasi kontak tidak diketahui");
        }

        $fee = $category->price;

        if ($user->balance >= $fee)
        {
            $user->balance = $user->balance - $fee;
            UserTransaction::executeTransaction($user->id, $fee * -1, "Pembayaran", UserTransaction::TYPE_FEE);
            return redirect($validTypes[$type].$user->contact_whatsapp);
        }
        else {
            return redirect()->route('listing.show', [$user])
                ->with('danger', "Tidak dapat menghubungi mitra saat ini");
        }
    }
}
