@extends('layouts.admin')

@section('title')
    {{ $user->id ? 'Edit Mitra '.$user->name : 'Tambah Mitra' }}
@endsection

@section('content')
    <div class="container">

        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('admin.admin_home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.partners.index') }}">Kelola Mitra</a></li>
            @if($user->id)
                <li class="breadcrumb-item"><a href="{{ route('admin.partners.edit', [$user]) }}">{{ $user->name}}</a></li>
            @endif
        </ul>

        <h2>@yield('title')</h2>
        <div class="card">
            <div class="card-body">
                <form action="{{ $user->id ? route('admin.partners.update', [$user]) : route('admin.partners.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Nama Mitra">
                    </div>

                    @error('name')
                    <div class="text-danger my-2">Nama harus diisi!</div>
                    @enderror

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email Mitra">
                    </div>

                    @error('email')
                    <div class="text-danger my-2">Email harus diisi dan berformat email!</div>
                    @enderror

                    <div class="form-group">
                        <label>Kontak utama</label>
                        <input type="tel" class="form-control" name="contact" value="{{ $user->contact }}" placeholder="Kontak utama">
                    </div>

                    @error('contact')
                    <div class="text-danger my-2">Kontak harus diisi!</div>
                    @enderror

                    <div class="form-group">
                        <label>Whatsapp</label>
                        <input type="tel" class="form-control" name="contact_whatsapp" value="{{ $user->contact_whatsapp }}" placeholder="Whatsapp">
                    </div>

                    @error('contact_whatsapp')
                    <div class="text-danger my-2">Kontak Whatsapp harus diisi!</div>
                    @enderror

                    <div class="form-group">
                        <label>Telegram</label>
                        <input type="tel" class="form-control" name="contact_telegram" value="{{ $user->contact_telegram }}" placeholder="Telegram">
                    </div>

                    @error('contact_telegram')
                    <div class="text-danger my-2">Kontak Telegram harus diisi!</div>
                    @enderror

                    <div class="form-group">
                        <label>Kata Sandi</label>
                        <input type="password" class="form-control" name="password" value="" placeholder="Kata Sandi">
                    </div>

                    @error('password')
                    <div class="text-danger my-2">Kata sandi harus diisi!</div>
                    @enderror

                    <div class="form-group">
                        <select name="city_id" id="city_id" class="form-control">
                            <option value="">Pilih Kota</option>
                            @foreach($cities as $city)
                                <optgroup label="{{ $city->name }}">
                                    @foreach($city->cities as $c)
                                        <option value="{{ $c->id }}" {{ $c->id == $user->city_id ? 'selected' : '' }}>{{ $c->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    @error('city_id')
                    <div class="text-danger my-2">Kota harus dipilih!</div>
                    @enderror

                    <div class="form-group">
                        <label>Biodata/Keterangan</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Bio, Keterangan, atau deskripsi layanan">{{ $user->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <textarea name="address" id="address" cols="30" rows="10" class="form-control" placeholder="Alamat">{{ $user->address }}</textarea>
                    </div>

                    <div class="form-group">
                        @if($user->image)
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="my-1"><img class="img-fluid img-thumbnail" src="{{ asset('storage/'.$user->image) }}" alt="Logo/Foto {{ $user->name }}"></div>
                                </div>
                            </div>
                        @endif
                        <label>Logo/Foto Diri</label>
                        <input type="file" name="image" class="form-control-file">
                    </div>

                    <div class=" text-center my-3">
                        <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

