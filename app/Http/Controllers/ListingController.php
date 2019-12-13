<?php

namespace App\Http\Controllers;

use App\User;
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
            ->paginate();

        return view('listing.index', [
            'users' => $users,
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

    public function contactWhatsapp(User $user)
    {
        return redirect("https://wa.me/".$user->contact_whatsapp);
    }
}
