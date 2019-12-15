<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserTransaction;
use Illuminate\Http\Request;

class UserTransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = UserTransaction::orderBy('id', 'desc')
            ->with(['user:id,name'])
            ->paginate();

        return view('admin.user_transactions.index', [
            'transactions' => $transactions,
        ]);
    }

    public function store(Request $request)
    {
        UserTransaction::executeTransaction(
            $request->input('user_id'),
            $request->input('amount'),
            $request->input('info'),
            $request->input('type')
        );

        return redirect()->route('admin.transactions.index')
            ->with('success', "Transaksi telah disimpan!");
    }
}
