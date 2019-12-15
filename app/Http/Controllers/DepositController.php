<?php

namespace App\Http\Controllers;

use App\DepositRequest;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Http\Request;

class DepositController extends Controller
{

    public function create(Request $request)
    {
        $banks = [
            [
                'bank' => setting(SettingsController::SETTING_DEPOSIT_ACCOUNT_BANK),
                'account' => setting(SettingsController::SETTING_DEPOSIT_ACCOUNT),
                'account_name' => setting(SettingsController::SETTING_DEPOSIT_ACCOUNT_NAME),
            ]
        ];
        return view('deposit.form', [
            'banks' => $banks,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination' => 'required',
            'amount' => 'required',
            'bank_name' => 'required',
            'account' => 'required',
            'account_name' => 'required',
        ]);

        $deposit = new DepositRequest();

        $deposit->user_id = auth()->id();
        $deposit->bank_name = $request->input('bank_name');
        $deposit->bank_account = $request->input('account');
        $deposit->bank_account_name = $request->input('account_name');
        $deposit->amount = $request->input('amount');
        $deposit->destination = $request->input('destination');
        $deposit->save();

        return redirect()->route('home')
            ->with('success', "Konfirmasi top up telah dikirim!");
    }
}
