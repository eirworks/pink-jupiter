@extends('layouts.app')

@section('title')
    Mitra {{ $pending ? 'Pending' : '' }}
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>
        <div class="card">
            <div class="card-body">
                <div class="mb-2 btn-group">
                    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">Tambah Mitra</a>
                    @if(!request()->has('pending'))
                    <a href="{{ route('admin.partners.index', ['pending' => 1]) }}" class="btn btn-outline-secondary">Mitra Pending</a>
                    @else
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">Semua Mitra</a>
                    @endif
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        @if(!$pending)
                        <th>Saldo</th>
                        @endif
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @if(!$pending)
                                <td>{{ $user->balance }}</td>
                                @endif
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="triggerId"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            Opsi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="triggerId">
                                            <a class="dropdown-item" href="{{ route('admin.partners.edit', [$user]) }}">Edit</a>
                                            @if($pending)
                                            <a href="#" class="dropdown-item" onclick="$('#activate-{{ $user->id }}').submit()">Aktifkan</a>
                                            @endif
                                            <a href="#" class="dropdown-item text-danger" onclick="$('#delete-{{ $user->id }}').submit()">Hapus</a>
                                        </div>
                                    </div>
                                    <form action="{{ route('admin.partners.activate', [$user]) }}" method="post" id="activate-{{ $user->id }}">@csrf @method('put')</form>
                                    <form action="{{ route('admin.partners.delete', [$user]) }}" method="post" id="delete-{{ $user->id }}">@csrf @method('delete')</form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

