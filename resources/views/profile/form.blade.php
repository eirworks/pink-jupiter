@extends('layouts.app')

@section('title')
    Edit Profil {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                                    <div class="text-danger my-2">Nomor telepon Whatsapp harus diisi!</div>
                                @enderror

                                <div class="form-group">
                                    <label for="">{{ __('profile.contact_telegram') }} (Opsional)</label>
                                    <input type="text" class="form-control" name="contact_telegram" value="{{ $user->contact_telegram }}" placeholder="Telegram">
                                </div>

                                <div class="form-group">
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Bio, Keterangan, atau deskripsi layanan">{{ $user->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <textarea name="address" id="address" cols="30" rows="10" class="form-control" placeholder="Alamat">{{ $user->address }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control" name="district" value="{{ $user->district }}">
                                </div>

                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input type="text" class="form-control" name="village" value="{{ $user->village }}">
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

                                <p>
                                    Pilih layanan yang anda sediakan:
                                </p>
                                <div class="alert alert-warning my-2">
                                    <b>Peringatan</b>: Merubah layanan akan merubah atau menghilangkan harga dan deskripsi yang sebelumnya telah
                                    ditentukan.
                                </div>
                                @error('categories')
                                    <div class="alert alert-danger">Mohon pilih paling tidak satu layanan</div>
                                @enderror

                                @foreach($categories as $category)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input id="category-{{ $category->id }}" type="checkbox" class="form-check-input" name="categories[]" {{ in_array($category->id, $user->category_ids) ? 'checked' : '' }} value="{{ $category->id }}">
                                                <label for="category-{{ $category->id }}" class="form-check-label">{{ $category->name }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    @if($category->children->count() > 0)
                                        <div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @foreach($category->children as $child)
                                                        <div class="form-check">
                                                            <input id="category-{{ $child->id }}" type="checkbox" class="form-check-input" name="categories[]" {{ in_array($child->id, $user->category_ids) ? 'checked' : '' }} value="{{ $child->id }}">
                                                            <label for="category-{{ $child->id }}" class="form-check-label">{{ $child->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach
                            @endif

                            <div class=" text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                @if($user->type == \App\User::TYPE_PARTNER)
                    <div class="card my-2">
                        <div class="card-header">
                            Tentukan Harga Layanan
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.update.services') }}" method="post">
                                @csrf
                                @method('put')
                                @foreach($user->categories as $category)
                                    <div class="mb-5">
                                        <div class="form-group">
                                            <label for="category-{{ $category->id }}">Harga Layanan {{ $category->name }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="text" class="form-control" name="category_prices[{{ $category->id }}]" value="{{ $category->pivot->price }}" placeholder="Harga layanan {{ $category->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Info Layanan {{ $category->name }}</label>
                                            <input type="text" class="form-control" name="category_descriptions[{{ $category->id }}]" value="{{ $category->pivot->description }}" placeholder="Deskripsikan apa yang dapat anda lakukan untuk layanan ini">
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

