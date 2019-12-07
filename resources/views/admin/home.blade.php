@extends('layouts.app')

@section('title')
    Admin Panel
@endsection

@section('content')
    <div class="container">
        <div class="mb-4">
            Hai,
            {{ auth()->user()->name }} <span class="badge badge-primary">Admin</span>
            &nbsp;
            <a href="#">edit profil</a>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div><span class="text-muted">Visitor Harian</span></div>
                        <div style="font-size: 2rem">{{ rand(10,99) }}</div>
                        <div class="mt-1">&uarr; {{ rand(1,5) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div><span class="text-muted">Visitor Bulanan</span></div>
                        <div style="font-size: 2rem">{{ rand(1000,5999) }}</div>
                        <div class="mt-1">&uarr; {{ rand(100,599) }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div><span class="text-muted">Mitra Aktif</span></div>
                        <div style="font-size: 2rem">{{ rand(50,99) }}</div>
                        <div class="mt-1">&uarr; {{ rand(10,29) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-5 row">
            <div class="col-md-3">
                <a href="#" class="panel-icon">
                    <div class="panel-icon-image-block">
                        <img class="panel-icon-image" src="{{ asset('images/icons/account-group.png') }}" alt="Kelola Mitra">
                    </div>
                    <div class="panel-icon-text">Mitra</div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.categories.index') }}" class="panel-icon">
                    <div class="panel-icon-image-block">
                        <img class="panel-icon-image" src="{{ asset('images/icons/tools.png') }}" alt="Kelola Layanan">
                    </div>
                    <div class="panel-icon-text">Layanan</div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="#" class="panel-icon">
                    <div class="panel-icon-image-block">
                        <img class="panel-icon-image" src="{{ asset('images/icons/shield-account.png') }}" alt="Kelola Layanan">
                    </div>
                    <div class="panel-icon-text">Admin</div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.provinces.all') }}" class="panel-icon">
                    <div class="panel-icon-image-block">
                        <img class="panel-icon-image" src="{{ asset('images/icons/city.png') }}" alt="Kelola Kota dan Provinsi">
                    </div>
                    <div class="panel-icon-text">Kota &amp; Provinsi</div>
                </a>
            </div>
        </div>
    </div>
@endsection

