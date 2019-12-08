<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        return view('partner.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->type = User::TYPE_PARTNER;
        $user->balance = 0;
        $user->activated = false;
        $user->contact = $request->input('contact');
        $user->data = [];
        $user->save();

        return redirect()->route('home')
            ->with('success', 'Pendaftaran berhasil dilakukan!');
    }
}
