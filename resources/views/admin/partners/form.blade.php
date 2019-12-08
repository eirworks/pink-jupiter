@extends('layouts.app')

@section('title')
    {{ $user->id ? 'Edit Mitra '.$user->name : 'Tambah Mitra' }}
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ $user->id ? route('admin.partners.update', [$user]) : route('admin.partners.store') }}" method="post">
                            @csrf

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
                                <input type="tel" class="form-control" name="contact" value="{{ $user->contact }}" placeholder="No HP/Whatsapp">
                            </div>

                            @error('email')
                            <div class="text-danger my-2">Kontak harus diisi!</div>
                            @enderror

                            <div class="form-group">
                                <input type="password" class="form-control" name="password" value="" placeholder="Kata Sandi">
                            </div>

                            <div class="form-group">
                                <select name="city_id" id="city_id" class="form-control">
                                    <option value="">Pilih Kota</option>
                                    @foreach($cities as $city)
                                        <optgroup label="{{ $city->name }}">
                                            @foreach($city->cities as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            @error('city_id')
                            <div class="text-danger my-2">Kota harus dipilih!</div>
                            @enderror

                            <div class=" text-center">
                                <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

