@extends('layouts.app')

@section('content')
    <search-form url="{{ route('home') }}" :catid="{{ request()->input('category_id', 0) }}" :cityid="{{ request()->input('city_id',0) }}"></search-form>

    <div class="container">
        @if($users->count())
            @if(setting('default_listing_ui', 'row') == 'row')
                @foreach($users as $user)
                    <div class="card my-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 d-none d-md-block text-center">
                                    @if($user->image)
                                        <img src="{{ \Storage::disk('public')->url($user->image) }}" alt="{{ $user->name }}" class="img-thumbnail img-fluid profile-image">
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <div class="mb-1">
                                        <a href="{{ route('listing.show', [$user]) }}" class="btn btn-link mx-0 px-0">
                                            <strong>{{ $user->name }}</strong>
                                        </a>
                                    </div>
                                    <div class="text-muted my-2">
                                        {{ $user->city->name }}, {{ $user->city->province->name }}
                                    </div>
                                    <div class="my-2">
                                        @include('includes.short_user_description')
                                    </div>
                                    <div class="mt-2">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach($users->chunk(4) as $userChunk)
                    <div class="row">
                        @foreach($userChunk as $user)
                            <div class="col-md-3 col-6 px-1 px-md-2">
                                <div class="card my-3 p-2">
                                    <div class="card-body">
                                        <div class="text-center">
                                            @if($user->image)
                                                <img src="{{ \Storage::disk('public')->url($user->image) }}" alt="{{ $user->name }}" class="img-thumbnail img-fluid">
                                            @endif
                                        </div>
                                        <div class="d-block">
                                            <div class="my-1 text-center">
                                                <a href="{{ route('listing.show', [$user]) }}" class="btn btn-link mx-0 px-0">
                                                    <strong>{{ $user->name }}</strong>
                                                </a>
                                            </div>
                                            <div class="text-muted text-sm-center">
                                                <small>
                                                    {{ $user->city->name }}, {{ $user->city->province->name }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
            {!! $users->links() !!}
        @else
            <div class="text-center text-muted">
                Tidak dapat menemukan hasil apapun.
            </div>
        @endif
    </div>
@endsection
