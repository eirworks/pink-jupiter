@extends('layouts.app')

@section('title')
    Pencarian Mitra
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>

        @if($users->count())
            @foreach($users as $user)
                <div class="card my-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 d-none d-md-block">
                                @if($user->image)
                                    <img src="{{ \Storage::disk('public')->url($user->image) }}" alt="{{ $user->name }}" class="img-thumbnail img-fluid profile-image">
                                @endif
                            </div>
                            <div class="col-md-10">
                                <div class="mb-1">
                                    <strong>{{ $user->name }}</strong>
                                </div>
                                <div>
                                    {{ strlen($user->description) > 140 ? substr($user->description, 0, 140)."..." : $user->description }}
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('listing.show', [$user]) }}" class="btn btn-outline-primary">Lihat Profil</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center text-muted">
                Tidak dapat menemukan hasil apapun.
            </div>
        @endif
    </div>
@endsection

