@extends('layouts.app')

@section('title')
    Pengaturan
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.settings.update') }}" method="post">
                            @csrf
                            @foreach($settings as $setting)
                                <div class="form-group">
                                    <label>{{ $setting['name'] }}</label>
                                    @if($setting['type'] == 'number')
                                        <input type="number" class="form-control" name="settings[{{ $setting['key'] }}]" value="{{ $setting['value'] }}">
                                    @elseif($setting['type'] == 'text')
                                        <textarea name="settings[{{ $setting['key'] }}]" id="settings-{{ $setting['key'] }}" cols="30" rows="10" class="form-control">{{ $setting['value'] }}</textarea>
                                    @else
                                        <input type="text" class="form-control" name="settings[{{ $setting['key'] }}]" value="{{ $setting['value'] }}">
                                    @endif
                                </div>
                            @endforeach
                            <div class="my-2">
                                <button class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.home') }}" class="btn btn-link">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

