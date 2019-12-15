@extends('layouts.app')

@section('title')
    Deposit Saldo
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('deposit.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label>Pilih Rekening Tujuan</label>
                                @foreach($banks as $idx => $bank)
                                    <div class="form-check">
                                        <input type="radio" id="destination-{{ $idx }}" name="destination" value="{{ $bank['bank']." ".$bank['account']." ".$bank['account_name'] }}" class="form-check-input">
                                        <label class="form-check-label" for="destination-{{ $idx }}">{{ $bank['bank'] }} {{ $bank['account'] }} {{ $bank['account_name'] }}</label>
                                    </div>
                                @endforeach
                                @error('destination')
                                    <div class="alert alert-danger">Pilih No. rekening tujuan</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Jumlah (minimal Rp{{ number_format(setting(\App\Http\Controllers\Admin\SettingsController::SETTING_MIN_DEPOSIT, 0), 2, ',', '.') }})</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="number" name="amount" min="10000" class="form-control" placeholder="Masukkan nilai top up anda">
                                </div>
                            </div>

                            @error('amount')
                                <div class="alert alert-danger">Top Up harus diisi dan minimal Rp{{ setting(\App\Http\Controllers\Admin\SettingsController::SETTING_MIN_DEPOSIT)  }}!</div>
                            @enderror

                            <div class="form-group">
                                <label for="bank_name">Nama Bank</label>
                                <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="contoh: BCA, BRI, Mandiri">
                            </div>

                            @error('bank_name')
                            <div class="alert alert-danger">Nama bank harus diisi!</div>
                            @enderror

                            <div class="form-group">
                                <label for="account">Nomor Rekening Bank Anda</label>
                                <input type="text" class="form-control" name="account" id="account">
                            </div>

                            @error('account')
                            <div class="alert alert-danger">Nomor rekening bank harus diisi!</div>
                            @enderror

                            <div class="form-group">
                                <label for="account_name">Nama Pemilik Rekening</label>
                                <input type="text" class="form-control" name="account_name" id="account_name">
                            </div>

                            @error('account_name')
                            <div class="alert alert-danger">Nama pemilik rekening bank harus diisi!</div>
                            @enderror

                            <div>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

