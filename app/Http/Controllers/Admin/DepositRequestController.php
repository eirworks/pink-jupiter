<?php

namespace App\Http\Controllers\Admin;

use App\DepositRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepositRequestController extends Controller
{
    public function index(Request $request)
    {
        $depositRequests = DepositRequest::orderBy('confirmed', 'asc')
            ->orderBy('id', 'asc')
            ->with(['user:id,name'])
            ->paginate();

        return view('admin.deposits.index', [
            'deposits' => $depositRequests,
        ]);
    }

    public function show(DepositRequest $request)
    {
        $request->load('user:id,name');
        return view('admin.deposits.show', [
            'depositRequest' => $request,
        ]);
    }

    public function update(DepositRequest $request)
    {
        $request->confirmed = true;
        $request->save();

        // TODO add into user's transaction

        return redirect()->route('admin.deposits.index')
            ->with('success', "Top up telah diterima!");
    }

    public function destroy(DepositRequest $request)
    {
        if ($request->confirmed)
        {
            return redirect()->route('admin.deposits.index')
                ->with('danger', "Konfirmasi Top up yang sudah diterima tidak dapat dihapus!");
        }
        $request->delete();

        return redirect()->route('admin.deposits.index')
            ->with('success', "Top up telah dihapus!");
    }
}
