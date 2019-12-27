@extends('layouts.admin')

@section('title')
    Konfirmasi Top Up #{{ $depositRequest->id }}
@endsection

@section('content')
    <div class="container">

        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Beranda Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.deposits.index') }}">Konfirmasi Top Up</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.deposits.show', [$depositRequest]) }}">Konfirmasi Top Up #{{ $depositRequest->id }}</a></li>
        </ul>

        <h2>@yield('title')</h2>

        <div class="card">
            <div class="card-body">
                <dl>
                    <dt>Status</dt>
                    <dd>
                        <span class="badge badge-{{ $depositRequest->confirmed ? 'success' : 'secondary' }}">{{ $depositRequest->confirmed ? 'Diterima' : 'Belum Diterima' }}</span>
                    </dd>
                    <dt>Mitra</dt>
                    <dd>{{ $depositRequest->user->name }}</dd>
                    <dt>Jumlah</dt>
                    <dd>{{ number_format($depositRequest->amount, 2, ',', '.') }}</dd>
                    <dt>Rekening Bank</dt>
                    <dd>
                        {{ $depositRequest->bank_name }}
                        {{ $depositRequest->bank_account }}
                        {{ $depositRequest->bank_account_name }}
                    </dd>
                    <dt>Tujuan</dt>
                    <dd>
                        {{ $depositRequest->destination }}
                    </dd>
                </dl>
                @if(!$depositRequest->confirmed)
                    <form action="{{ route('admin.deposits.update', [$depositRequest]) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="my-2">
                            <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
                        </div>
                    </form>
                    <form action="{{ route('admin.deposits.delete', [$depositRequest]) }}" method="post">
                        @method('delete')
                        @csrf
                        <div class="my-2">
                            <button type="submit" class="btn btn-outline-danger">Hapus</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

