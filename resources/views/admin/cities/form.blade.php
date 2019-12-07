@extends('layouts.app')

@section('title')
    {{ $city->id ? 'Edit Kota '.$city->name : "Tambah Kota" }}
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-2">
                    <div class="card-body">
                        <form action="{{ $city->id ? route('admin.cities.edit', [$city]) : route('admin.cities.store') }}" method="post">
                            @csrf
                            @if($city->id) @method('put') @endif
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="{{ $city->name }}" placeholder="Nama kota">
                            </div>

                            @if(request()->filled('province_id') && $city->id == 0)
                                <input type="hidden" name="province_id" value="{{ request()->input('province_id') }}">
                            @endif

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

