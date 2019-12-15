@extends('layouts.app')

@section('title')
    Transaksi Mitra
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Panel Admin</a></li>
        </ul>
        <h2>@yield('title')</h2>
        <div class="card">
            <div class="card-body">

                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Waktu</th>
                        <th>Tipe</th>
                        <th>Nama</th>
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
                            <td>{{ $transaction->user->name }}</td>
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

