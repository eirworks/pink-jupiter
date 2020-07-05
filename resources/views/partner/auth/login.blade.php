@extends('layouts.app')

@section('title')
    Login Mitra
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">@yield('title')</div>
                    <div class="card-body">
                        <form action="{{ route('partner.login.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('auth.phone') }}</label>
                                <input type="tel" class="form-control" name="phone" placeholder="{{ __('auth.phone') }}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('auth.password') }}</label>
                                <input type="password" class="form-control" name="password" placeholder="{{ __('auth.password') }}">
                            </div>

                            <div class="my-2 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">{{ __('auth.login') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

