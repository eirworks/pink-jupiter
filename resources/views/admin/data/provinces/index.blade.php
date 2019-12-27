@extends('layouts.admin')

@section('title')
    Kelola Provinsi dan Kota/Kabupaten
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>

        <div class="alert alert-info my-2">
            Data kota dan provinsi tidak dapat diubah.
            Informasi ini otomatis diambil dari layanan Raja Ongkir.
        </div>

        <div class="my-2">
            <a href="{{ route('admin.provinces.create') }}" class="btn btn-primary">Tambah Provinsi</a>
        </div>

        <div class="card my-2">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Provinsi</th>
                        <th>Kota</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($provinces as $province)
                        <tr>
                            <td colspan="2" class="bg-light">{{ $province->name }}</td>
                            <td class="bg-light">
                                <div class="btn-group btn-group-sm">
                                    <a class="btn btn-outline-secondary" href="{{ route('admin.provinces.edit', [$province]) }}">Edit provinsi</a>
                                    <button type="button"
                                            class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('admin.cities.create', ['province_id' => $province->id]) }}" class="dropdown-item">Tambah kota</a>
                                        <a onclick="$('#delete-province-{{ $province->id }}').submit()" class="dropdown-item text-danger">Hapus</a>
                                    </div>
                                </div>
                                <form class="d-none" action="{{ route('admin.provinces.delete', [$province]) }}" id="delete-province-{{ $province->id }}" method="post">@csrf @method('delete')</form>
                            </td>
                        </tr>
                        @foreach($province->cities as $city)
                        <tr>
                            <td></td>
                            <td>{{ $city->name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="triggerId"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                        <a href="{{ route('admin.cities.edit', [$city]) }}" class="dropdown-item">edit</a>
                                        <a onclick="$('#delete-city-{{ $city->id }}').submit()" class="dropdown-item text-danger">hapus</a>
                                    </div>
                                </div>
                                <form id="delete-city-{{ $city->id }}" action="{{ route('admin.cities.delete', [$city]) }}" method="post" class="d-none">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

