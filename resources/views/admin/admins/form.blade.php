@extends('layouts.app')

@section('title')
    {{ $user->id ? 'Edit Admin '.$user->name : 'Tambah Customer'  }}
@endsection

@section('content')
    <div class="container">

        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.admin.index') }}">Kelola Admin</a></li>
        </ul>

        <h2>@yield('title')</h2>

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-body">
                        <form action="{{ $user->id ? route('admin.admin.update', [$user]) : route('admin.admin.store') }}">
                            @csrf
                            @if($user->id) @method('put') @endif

                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Nama Mitra">
                            </div>

                            @error('name')
                            <div class="text-danger my-2">Nama harus diisi!</div>
                            @enderror

                            <div class="form-group">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email Mitra">
                            </div>

                            @error('email')
                            <div class="text-danger my-2">Email harus diisi dan berformat email!</div>
                            @enderror

                            <div class="form-group">
                                <input type="password" class="form-control" name="password" value="" placeholder="Kata Sandi">
                                <div class="my-2 text-muted">
                                    Biarkan kosong jika tidak ingin mengganti kata sandi.
                                </div>
                            </div>

                            @error('password')
                            <div class="text-danger my-2">Kata sandi harus diisi!</div>
                            @enderror

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="admin_manager" value="1" {{ $user->admin_manager ? 'checked' : '' }}>
                                <label class="form-check-label">Kelola admin</label>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.admin.index') }}" class="btn btn-link">Batal</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

