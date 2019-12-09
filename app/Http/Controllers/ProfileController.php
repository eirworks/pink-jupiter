<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('admin.partners.form', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
            'password' => 'required',
            'city_id' => 'min:1',
        ]);

        $this->save($user, $request);
    }

    private function save($user, $request)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->city_id = $request->input('city_id');
        $user->contact = $request->input('contact');
        $user->activated = true;
        $user->type = User::TYPE_PARTNER;
        $user->balance = 0;
        $user->data = [];
        $user->save();

        return $user;
    }
}
