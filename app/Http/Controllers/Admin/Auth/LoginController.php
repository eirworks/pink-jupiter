<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.admin.login');
    }

    public function submitLogin(Request $request)
    {
        $request->validate(['email' => 'required', 'password' => 'required']);

        $loginAttempt = auth()->attempt($request->only(['email', 'password']));

        if (!$loginAttempt)
        {
            return redirect()->route('admin.login')->with(['error' => __('auth.failed')]);
        }

        return redirect()->route('home');
    }
}
