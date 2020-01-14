@extends('layouts.app')

@section('title')
    {{ $service->id ? 'Edit Iklan '.$service->name : 'Buat Iklan' }}
@endsection

@section('content')
    <div class="container">

        <ul class="breadcrumb">
            <li><a href="{{ route('partner.services.index') }}">Kelola Iklan</a></li>
        </ul>

        <h2 class="my-2">@yield('title')</h2>

        <div class="card">
            <div class="card-body">
                <form action="{{ $service->id ? route('partner.services.update', [$service]) : route('partner.services.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Judul Iklan</label>
                        <input type="text" class="form-control" name="name" value="{{ $service->name }}">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Iklan</label>
                        <textarea name="description" id="description" cols="30" rows="10"
                                  class="form-control">{{ $service->description }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Lokasi</label>
                                <select-city :city-id="{{ $service->city_id }}"></select-city>
                                @if($service->id)
                                    <div class="my-2">Kota dipilih: <strong>{{ $service->city->name }}</strong></div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Kategori</label>
                                <select-category :category-id="{{ $service->category_id }}"></select-category>
                                @if($service->id)
                                    <div class="my-2">Pilihan saat ini: <strong>{{ $service->category->name }}</strong></div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Harga (Rp)</label>
                        <input type="number" name="price" value="{{ intval($service->price) }}" class="form-control">
                    </div>

                    <div class="form-check form-check-inline my-3">
                        <div>
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="activated" {{ $service->activated ? 'checked' : '' }}>
                                Aktifkan iklan ini?
                            </label>
                        </div>
                    </div>


                    <div class="form-group">
                        @if($service->id)
                            @if($service->image)
                                <div class="row">
                                    <div class="col-md-3">
                                        <img class="img-fluid img-thumbnail" src="{{ \Storage::disk('public')->url($service->image) }}" alt="Gambar">
                                    </div>
                                </div>
                            @endif
                        @endif
                        <label>Foto</label>
                        <input type="file" name="image" class="form-control-file">
                    </div>

                    <div class="text-center">
                        <button class="btn btn-lg btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

