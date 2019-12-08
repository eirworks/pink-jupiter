@extends('layouts.app')

@section('title')
    Pendaftaran Mitra
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        Pendaftaran Mitra
                    </div>
                    <div class="card-body">
                        <form action="{{ route('partner.register.submit') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Alamat Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Kata Sandi">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="contact" placeholder="No HP/Whatsapp">
                            </div>

                            <div class="text-center">
                                <button class="btn btn-primary btn-lg">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

