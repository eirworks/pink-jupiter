<?php

namespace App\Http\Controllers;

use App\UserTransaction;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $transactions = auth()->user()->transactions()
            ->orderBy('id', 'desc')
            ->paginate();

        return view('user_transactions.index', [
            'transactions' => $transactions,
            'user' => $user,
        ]);
    }
}
