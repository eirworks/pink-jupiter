@extends('layouts.app')

@section('title')
    Login Admin
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('auth.admin_login') }}</div>
                    <div class="card-body">
                        <form action="{{ route('admin.login.submit') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="{{ __('auth.email') }}">
                            </div>
                            <div class="form-group">
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

