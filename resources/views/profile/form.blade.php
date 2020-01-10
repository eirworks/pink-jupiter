@extends('layouts.app')

@section('title')
    Edit Profil {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <div class="card my-3">
            <div class="card-header text-center">@yield('title')</div>
            <div class="card-body">

                @if($user->image)
                    <div class="text-center">
                        <img src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->name }}" class="img-thumbnail">
                    </div>
                @endif

                <dl>
                    <dt>Tipe Akun</dt>
                    <dd>
                        @include('includes.user_type', ['user_type' => $user->type])
                    </dd>
                    @if($user->type == \App\User::TYPE_PARTNER)
                        <dt>Saldo</dt>
                        <dd class="my-1">
                            @include('includes.user_balance')
                            <a href="{{ route('deposit.create') }}" class="px-2">Top Up</a>
                        </dd>
                        <dt>Status</dt>
                        <dd class="my-1">
                            @if($user->activated)
                                <span class="badge badge-success">Aktif</span>
                            @endif
                        </dd>
                        <dt>Verifikasi:</dt>
                        <dd class="my-1">
                            @if($user->verified)
                                <span class="text-success">Akun telah diverifikasi!</span>
                            @else
                                Akun belum diverifikasi, mohon lengkapi data diri anda.
                            @endif
                        </dd>
                    @endif
                </dl>

                <hr>

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
                            <label>Alamat Lengkap</label>
                            <textarea name="address" id="address" cols="30" rows="10" class="form-control" placeholder="Alamat">{{ $user->address }}</textarea>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label>{{ __('profile.pick_city') }}</label>--}}
{{--                            <select name="city_id" id="city_id" class="form-control">--}}
{{--                                <option value="">Pilih Kota</option>--}}
{{--                                @foreach($cities as $city)--}}
{{--                                    <optgroup label="{{ $city->name }}">--}}
{{--                                        @foreach($city->cities as $c)--}}
{{--                                            <option value="{{ $c->id }}" {{ $c->id == $user->city_id ? 'selected' : '' }}>{{ $c->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </optgroup>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        @error('city_id')--}}
{{--                        <div class="text-danger my-2">Kota harus dipilih!</div>--}}
{{--                        @enderror--}}

                        <hr>
                        <h3>Informasi Bisnis</h3>

                        <div class="form-group">
                            <label for="">Nama Bisnis (Opsional)</label>
                            <input type="text" class="form-control" name="business_name" value="{{ $user->business_name }}" placeholder="Nama bisnis anda atau nama anda">
                        </div>

                        <div class="form-group">
                            <label>Deskripsikan Bisnis Anda</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Bio, Keterangan, atau deskripsi layanan">{{ $user->description }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ __('profile.contact') }}</label>
                                    <input type="tel" class="form-control" name="contact" value="{{ $user->contact }}" placeholder="No HP/Whatsapp">
                                </div>

                                @error('contact')
                                <div class="text-danger my-2">Kontak harus diisi!</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('profile.contact_whatsapp') }}</label>
                                    <input type="tel" class="form-control" name="contact_whatsapp" value="{{ $user->contact_whatsapp }}" placeholder="Whatsapp">
                                </div>

                                @error('contact_whatsapp')
                                <div class="text-danger my-2">Nomor telepon Whatsapp harus diisi!</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('profile.contact_telegram') }} (Opsional)</label>
                                    <input type="text" class="form-control" name="contact_telegram" value="{{ $user->contact_telegram }}" placeholder="Telegram">
                                </div>
                            </div>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label>Kecamatan</label>--}}
{{--                            <input type="text" class="form-control" name="district" value="{{ $user->district }}">--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label>Kelurahan</label>--}}
{{--                            <input type="text" class="form-control" name="village" value="{{ $user->village }}">--}}
{{--                        </div>--}}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Logo/Foto</label>
                                    @if($user->image)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="my-1"><img class="img-fluid img-thumbnail" src="{{ asset('storage/'.$user->image) }}" alt="Logo/Foto {{ $user->name }}"></div>
                                            </div>
                                        </div>
                                    @endif
                                    <input type="file" name="image" class="form-control-file">
                                </div>
                            </div>

{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    @if($user->id_card_image)--}}
{{--                                        <div class="my-1"><img class="img-fluid img-thumbnail" src="{{ asset('storage/'.$user->id_card_image) }}" alt="Foto KTP {{ $user->name }}"></div>--}}
{{--                                    @endif--}}
{{--                                    <label for="id_card_image">Foto KTP</label>--}}
{{--                                    <input id="id_card_image" type="file" name="id_card_image" class="form-control-file">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>

{{--                        <p>--}}
{{--                            Pilih layanan yang anda sediakan:--}}
{{--                        </p>--}}

{{--                        @error('categories')--}}
{{--                        <div class="alert alert-danger">Mohon pilih paling tidak satu layanan</div>--}}
{{--                        @enderror--}}

{{--                        @foreach($categories as $category)--}}
{{--                            <div class="mb-2 mt-3"><strong>{{ $category->name }}</strong></div>--}}

{{--                            @if($category->children->count() > 0)--}}
{{--                                @foreach($category->children->chunk(3) as $childChunk)--}}
{{--                                    <div class="row">--}}
{{--                                        @foreach($childChunk as $child)--}}
{{--                                            <div class="col-md-4">--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input id="category-{{ $child->id }}" type="checkbox" class="form-check-input" name="categories[]" {{ in_array($child->id, $user->category_ids) ? 'checked' : '' }} value="{{ $child->id }}">--}}
{{--                                                    <label for="category-{{ $child->id }}" class="form-check-label">{{ $child->name }}</label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}

{{--                        @endforeach--}}
                    @endif

                    <div class=" text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

