@extends('layouts.admin')

@section('title')
    {{ $province->id ? 'Edit Provinsi '.$province->name : "Tambah Provinsi" }}
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-2">
                    <div class="card-body">
                        <form action="{{ $province->id ? route('admin.provinces.update', [$province]) : route('admin.provinces.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="{{ $province->name }}" placeholder="Nama provinsi">
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.provinces.all') }}" class="btn btn-link">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

