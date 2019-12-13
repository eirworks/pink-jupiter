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
            <a href="{{ route('profile.edit') }}">edit profil</a>
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

        @foreach(collect($menus)->chunk(4) as $menuChunk)
        <div class="my-4 row">
            @foreach($menuChunk as $menu)
            <div class="col-md-3">
                <a href="{{ $menu['url'] }}" class="panel-icon" title="{{ $menu['hint'] }}">
                    <div class="panel-icon-image-block">
                        <img class="panel-icon-image" src="{{ $menu['icon'] }}" alt="{{ $menu['name'] }}">
                    </div>
                    <div class="panel-icon-text">{{ $menu['name'] }}</div>
                </a>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
@endsection

