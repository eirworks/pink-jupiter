@extends('layouts.app')

@section('title')
    Pendaftaran Mitra
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        Pendaftaran Mitra
                    </div>
                    <div class="card-body">
                        <form action="{{ route('partner.register.submit') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Alamat Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Kata Sandi">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="contact_whatsapp" placeholder="Kontak Whatsapp">
                            </div>
                            <div class="form-group">
                                <textarea name="description" id="description" cols="30" rows="4"
                                          class="form-control" placeholder="Info tentang bisnis/usaha anda"></textarea>
                            </div>
                            <div class="form-group">
                                <textarea name="address" id="address" cols="30" rows="2"
                                          class="form-control" placeholder="Alamat lengkap"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="city_id">Pilih Kota</label>
                                <select name="city_id" id="city_id" class="form-control">
                                    <option value="">Pilih kota</option>
                                    @foreach($provinces as $province)
                                        <optgroup label="{{ $province->name }}">
                                            @foreach($province->cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="district" placeholder="Kecamatan/Distrik">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="village" placeholder="Kelurahan/Desa">
                            </div>

                            <div class="my-2 text-muted font-italic">
                                Dengan menekan tombol daftar, anda telah menyetujui ketentuan layanan mitra
                                dan kebijakan privasi kami.
                            </div>

                            <div class="text-center">
                                <button class="btn btn-primary btn-lg">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

