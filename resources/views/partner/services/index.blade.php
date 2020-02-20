@extends('layouts.app')

@section('title')
    Kelola Iklan Anda
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>

        <div class="mb-3">
            <a href="{{ route('partner.services.new') }}" class="btn btn-primary">Buat Iklan</a>

            <span class="ml-3">
                Anda menggunakan
                <strong>{{ $services->total() }}</strong>
                dari
                <strong>{{ setting('ads_per_user', 10) }}</strong>
                slot iklan.
            </span>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Klik Unik</th>
                <th>Aktif?</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>
                        <a href="{{ route('partner.services.edit', [$service]) }}">{{ $service->name }}</a>
                    </td>
                    <td>{{ $service->clicks_count }}</td>
                    <td>{{ $service->activated ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('partner.services.edit', [$service]) }}" class="btn btn-link">Edit</a>
                            <a href="javascript:" onclick="$('#delete-{{ $service->id }}').submit()" class="btn btn-link">Hapus</a>
                        </div>
                        <form action="{{ route('partner.services.destroy', [$service]) }}" method="post" id="delete-{{ $service->id }}">@csrf @method('delete')</form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $services->links() !!}
    </div>
@endsection

