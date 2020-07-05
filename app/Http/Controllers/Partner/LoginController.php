<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Waavi\Sanitizer\Sanitizer;

class LoginController extends Controller
{
    public function index()
    {
        return view('partner.auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'password' => 'required',
        ]);

        $sanitizer = new Sanitizer($request->all(), [
            'phone' => 'digit|trim',
        ]);
        $sanitizedRequests = $sanitizer->sanitize();

        $loginAttempt = Auth::attempt([
            'contact' => $sanitizedRequests['phone'],
            'password' => $request->input('password')
        ]);

        if (!$loginAttempt)
        {
            return redirect()->route('partner.login')
                ->with('danger', "Akun tidak ditemukan!");
        }

        return redirect()->route('home');
    }

    private function sanitizePhoneNumber(Request $request) {

    }
}
