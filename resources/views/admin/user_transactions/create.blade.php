@extends('layouts.app')

@section('title')
    Tambah Transaksi pada {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">@yield('title')</h2>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('admin.transactions.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="form-group"><label for="amount">Jumlah</label><input type="number" name="amount"
                                                                                             placeholder="Masukkan jumlah, beri nilai minus untuk pengeluaran"
                                                                                             id="amount"
                                                                                             min="1"
                                                                                             class="form-control"></div>

                            <div class="form-group"><label for="type">Tipe Transaksi</label><select name="type" id="type"
                                                                                                    class="form-control">
                                    <option value="{{ \App\UserTransaction::TYPE_DEPOSIT }}">Deposit</option>
                                    <option value="{{ \App\UserTransaction::TYPE_FEE }}">Fee</option>
                                </select></div>

                            <div class="form-group"><label for="info">Info</label><input type="text" name="info"
                                                                                         placeholder="Misal: Deposit mitra"
                                                                                         id="info" class="form-control">
                            </div>

                            <div class="my-2 text-center">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

