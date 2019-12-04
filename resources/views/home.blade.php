@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control">
                        <option value="1">Pilih Provinsi</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control">
                        <option value="1">Pilih Kota</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control">
                        <option value="1">Layanan apa yang anda butuhkan?</option>
                    </select>
                </div>
            </div>

            <div class="my-3 text-center"><button class="btn btn-primary">Cari Layanan</button></div>
        </div>
    </div>
</div>
@endsection
