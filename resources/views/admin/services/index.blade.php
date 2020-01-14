@extends('layouts.admin')

@section('title')
    Kelola Iklan
@endsection

@section('content')
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin Panel</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Iklan</a></li>
        </ul>
        <h2>@yield('title')</h2>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Aktif?</th>
                <th>Tanggal</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>
                        {{ $service->name }}
                        <div class="small">
                            <strong>Oleh</strong>: {{ $service->user->name }}
                            <strong>Kota</strong>: {{ $service->city->name }}, {{ $service->city->province->name }}
                        </div>
                    </td>
                    <td>{{ $service->activated ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>{{ \Carbon\Carbon::parse($service->created_at)->format("d M Y") }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.services.edit', [$service]) }}" class="btn btn-link">Edit</a>
                            <a href="javascript:" onclick="$('#delete-{{ $service->id }}').submit()" class="btn btn-link">Hapus</a>
                        </div>
                        <form action="{{ route('admin.services.destroy', [$service]) }}" method="post" id="delete-{{ $service->id }}">@csrf @method('delete')</form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $services->links() !!}
    </div>
@endsection

