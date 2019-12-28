<?php

namespace App\Http\Controllers\Partner;

use App\City;
use App\Http\Controllers\Controller;
use App\Province;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        return view('partner.register', [
            'provinces' => Province::with(['cities'])->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'city_id' => 'required',
        ]);

        $user = new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->type = User::TYPE_PARTNER;
        $user->balance = 0;
        $user->activated = false;
        $user->contact = '';
        $user->contact_whatsapp = $request->input('contact_whatsapp');
        $user->contact_telegram = "";
        $user->address = $request->input('address');
        $user->description = $request->input('description');
        $user->city_id = $request->input('city_id');
        $user->district = $request->input('district');
        $user->village = $request->input('village');
        $user->open_hours = [];
        $user->id_card_image = '';
        $user->image = '';
        $user->data = [];
        $user->save();

        return redirect()->route('home')
            ->with('success', 'Pendaftaran berhasil dilakukan!');
    }
}
