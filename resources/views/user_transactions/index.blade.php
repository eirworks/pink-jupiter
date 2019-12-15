@extends('layouts.app')

@section('title')
    Riwayat Transaksi
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>
        <div class="card">
            <div class="card-body">

                <div class="my-2">
                    <dl>
                        <dt>Saldo</dt>
                        <dd>
                            @include('includes.user_balance')
                            <a href="{{ route('deposit.create') }}" class="mx-2">Top Up</a>
                        </dd>
                    </dl>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Waktu</th>
                        <th>Tipe</th>
                        <th>Info</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td>{{ strtoupper($transaction->type) }}</td>
                            <td>{{ $transaction->info }}</td>
                            <td class="text-danger">{{ $transaction->amount <= 0 ? "Rp".number_format($transaction->amount, 2) : '' }}</td>
                            <td class="text-success">{{ $transaction->amount > 0 ? "Rp".number_format($transaction->amount, 2) : '' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {!! $transactions->links() !!}
            </div>
        </div>
    </div>
@endsection

