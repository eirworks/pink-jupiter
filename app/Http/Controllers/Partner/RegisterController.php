<?php

namespace App\Http\Controllers\Partner;

use App\City;
use App\Http\Controllers\Controller;
use App\Province;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Waavi\Sanitizer\Sanitizer;

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
        $this->validate($request, [
            'name' => 'required',
            'business_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'city_id' => 'required',
            'contact' => 'required',
            'contact_whatsapp' => 'required',
            'district' => 'required',
            'village' => 'required',
        ]);

        $sanitizer = new Sanitizer($request->all(), [
            'contact' => 'digit|trim',
            'contact_whatsapp' => 'digit|trim',
        ]);
        $sanitizedRequests = $sanitizer->sanitize();

        $user = new User();

        $user->name = $request->input('name');
        $user->business_name = $request->input('business_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->type = User::TYPE_PARTNER;
        $user->balance = 0;
        $user->activated = true;
        $user->contact = $sanitizedRequests['contact'];
        $user->contact_whatsapp = $sanitizedRequests['contact_whatsapp'];
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

        auth()->login($user);

        return redirect()->route('home')
            ->with('success', 'Pendaftaran berhasil! Anda bisa membuat iklan melalui menu kelola iklan.');
    }
}
