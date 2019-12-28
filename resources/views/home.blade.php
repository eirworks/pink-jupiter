@extends('layouts.app')

@section('content')
    @include('homepage.search')

    <div class="container">
        @if($users->count())
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
                                    &nbsp;
                                    @if($user->categories->count() > 0)
                                        @foreach($user->categories as $category)
                                            <span class="badge badge-primary">{{ $category->name }}</span>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="my-2">
                                    {{ $user->description }}
                                </div>
                                <div class="mt-2">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
            @foreach($users->chunk(4) as $userChunk)
                <div class="row">
                    @foreach($userChunk as $user)
                        <div class="col-md-3">
                            <div class="card my-3 p-2">
                                <div class="card-body">
                                    <div class="text-center">
                                        @if($user->image)
                                            <img src="{{ \Storage::disk('public')->url($user->image) }}" alt="{{ $user->name }}" class="img-thumbnail img-fluid">
                                        @endif
                                    </div>
                                    <div class="d-block">
                                        <div class="mb-1 text-center">
                                            <a href="{{ route('listing.show', [$user]) }}" class="btn btn-link mx-0 px-0">
                                                <strong>{{ $user->name }}</strong>
                                            </a>
                                        </div>
                                        <div class="text-muted text-sm-center my-1">
                                            {{ $user->city->name }}, {{ $user->city->province->name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            {!! $users->links() !!}
        @else
            <div class="text-center text-muted">
                Tidak dapat menemukan hasil apapun.
            </div>
        @endif
    </div>
@endsection
@
