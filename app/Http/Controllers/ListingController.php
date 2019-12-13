<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\SettingsController;
use App\User;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $fee = setting('contact_fee', 0);

        $users = User::where('city_id', $request->input('city_id'))
            ->where('type', User::TYPE_PARTNER)
            ->whereHas('categories', function($query) use($request) {
                $query->where('category_id', $request->input('category_id'));
            })
            ->where('activated', true)
            ->where('verified', true)
            ->where('balance', '>=', $fee)
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
        $fee = intval(setting(SettingsController::SETTING_CONTACT_FEE, 0));
        if ($user->balance >= $fee)
        {
            $user->balance = $user->balance - $fee;
            return redirect("https://wa.me/".$user->contact_whatsapp);
        }
        else {
            return redirect()->route('listing.show', [$user])
                ->with('danger', "Tidak dapat menghubungi mitra saat ini");
        }
    }
}