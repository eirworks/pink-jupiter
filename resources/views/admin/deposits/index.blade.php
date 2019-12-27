@extends('layouts.admin')

@section('title')
    Konfirmasi Top Up
@endsection

@section('content')
    <div class="container">

        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Beranda Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.deposits.index') }}">Konfirmasi Top Up</a></li>
        </ul>

        <h2>@yield('title')</h2>

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Bank</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($deposits as $deposit)
                            <tr>
                                <td>{{ $deposit->id }}</td>
                                <td>
                                    <span class="badge badge-{{ $deposit->confirmed ? 'success' : 'secondary' }}">{{ $deposit->confirmed ? 'Diterima' : 'Belum' }}</span>
                                </td>
                                <td>{{ $deposit->user->name }}</td>
                                <td>{{ number_format($deposit->amount, 2, ',', '.') }}</td>
                                <td>
                                    {{ $deposit->bank_name }}
                                    {{ $deposit->bank_account }}
                                    {{ $deposit->bank_account_name }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.deposits.show', [$deposit]) }}" class="btn btn-sm btn-outline-secondary">Rincian</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $deposits->links() !!}
            </div>
        </div>
    </div>
@endsection

