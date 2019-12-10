@extends('layouts.app')

@section('title')
    Edit Profil {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">@yield('title')</div>
                    <div class="card-body">

                        @if($user->image)
                            <div class="text-center">
                                <img src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->name }}" class="img-thumbnail">
                            </div>
                        @endif

                        <ul class="list-unstyled">
                            <li>
                                Tipe Akun: @include('includes.user_type', ['user_type' => $user->type])
                            </li>
                            @if($user->type == \App\User::TYPE_PARTNER)
                                <li class="my-1">
                                    Saldo: @include('includes.user_balance')
                                </li>
                            @endif
                        </ul>

                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="form-group">
                                <label for="">{{ __('profile.full_name') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Nama Mitra">
                            </div>

                            @error('name')
                            <div class="text-danger my-2">{{ __('profile.validation_fail', ['key' => __('profile.name')]) }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="">{{ __('profile.email') }}</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email Mitra">
                            </div>

                            @error('email')
                            <div class="text-danger my-2">{{ __('profile.email_validation_fail') }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="">{{ __('profile.password') }}</label>
                                <input type="password" class="form-control" name="password" value="" placeholder="Kata Sandi">
                                <div class="text-muted my-1">
                                    {{ __('profile.password_help') }}
                                </div>
                            </div>

                            @if($user->type == \App\User::TYPE_PARTNER)
                                <div class="form-group">
                                    <label>{{ __('profile.pick_city') }}</label>
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
                                    <label>{{ __('profile.contact') }}</label>
                                    <input type="tel" class="form-control" name="contact" value="{{ $user->contact }}" placeholder="No HP/Whatsapp">
                                </div>

                                @error('contact')
                                <div class="text-danger my-2">Kontak harus diisi!</div>
                                @enderror

                                <div class="form-group">
                                    <label for="">{{ __('profile.contact_whatsapp') }}</label>
                                    <input type="tel" class="form-control" name="contact_whatsapp" value="{{ $user->contact_whatsapp }}" placeholder="Whatsapp">
                                </div>

                                @error('contact_whatsapp')
                                    <div class="text-danger my-2">Kontak harus diisi!</div>
                                @enderror

                                <div class="form-group">
                                    <label for="">{{ __('profile.contact_telegram') }}</label>
                                    <input type="tel" class="form-control" name="contact_telegram" value="{{ $user->contact_telegram }}" placeholder="Telegram">
                                </div>

                                @error('contact_telegram')
                                    <div class="text-danger my-2">Kontak harus diisi!</div>
                                @enderror

                                <div class="form-group">
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Bio, Keterangan, atau deskripsi layanan">{{ $user->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <textarea name="address" id="address" cols="30" rows="10" class="form-control" placeholder="Alamat">{{ $user->address }}</textarea>
                                </div>

                                <div class="form-group">
                                    @if($user->image)
                                        <div class="my-1"><img class="img-fluid img-thumbnail" src="{{ asset('storage/'.$user->image) }}" alt="Logo/Foto {{ $user->name }}"></div>
                                    @endif
                                    <label>Logo/Foto Diri</label>
                                    <input type="file" name="image" class="form-control-file">
                                </div>

                                <div class="form-group">
                                    @if($user->id_card_image)
                                        <div class="my-1"><img class="img-fluid img-thumbnail" src="{{ asset('storage/'.$user->id_card_image) }}" alt="Foto KTP {{ $user->name }}"></div>
                                    @endif
                                    <label for="id_card_image">Foto KTP</label>
                                    <input id="id_card_image" type="file" name="id_card_image" class="form-control-file">
                                </div>
                            @endif

                            <div class=" text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

