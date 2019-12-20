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
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            @foreach($settingGroups as $id => $name)
                                <li class="nav-item">
                                    <a class="nav-link {{ $id == request()->input('id', 'site') ? 'active' : '' }}" href="{{ route('admin.settings.edit', ['id' => $id]) }}" title="{{ $id }}">{{ $name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            @foreach($settings as $setting)
                                <div class="form-group">
                                    <label>{{ $setting['name'] }}</label>
                                    @if($setting['type'] == 'number')
                                        <input type="number" class="form-control" name="settings[{{ $setting['key'] }}]" value="{{ $setting['value'] }}">
                                    @elseif($setting['type'] == 'boolean')
                                        <div class="form-check">
                                            <input type="hidden" name="settings[{{ $setting['key'] }}]" value="0">
                                            <input type="checkbox" id="{{ $setting['key'] }}" class="form-check-input" name="settings[{{ $setting['key'] }}]" value="1" {{ $setting['value'] ? 'checked' : '' }}>
                                            <label for="{{ $setting['key'] }}">{{ $setting['name'] }}</label>
                                        </div>
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

