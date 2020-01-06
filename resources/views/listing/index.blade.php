@extends('layouts.app')

@section('title')
    Pencarian Mitra
@endsection

@section('content')
    <search-form url="{{ route('listing.index') }}" :cityid="{{ request()->input('city_id') }}" :catid="{{ request()->input('category_id') }}"></search-form>
    <div class="container">

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
                                <div class="text-muted my-1">
                                    {{ $user->district }}/{{ $user->village }},
                                    {{ $user->city->name }}, {{ $user->city->province->name }}
                                </div>
                                <div>
                                    @include('includes.short_user_description')
                                </div>

                                @if(request()->filled('category_id'))
                                    <div class="btn-group mt-3">
                                        <a class="btn btn-outline-primary" href="{{ route('listing.contact', [$user, 'type' => 'wa', request()->input('category_id') ]) }}" target="_blank">Whatsapp</a>
                                        @if($user->contact_telegram)
                                            <a class="btn btn-outline-primary" href="{{ route('listing.contact', [$user, 'type' => 'tg', request()->input('category_id') ]) }}" target="_blank">Telegram</a>
                                        @endif
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center text-muted my-5">
                Tidak dapat menemukan hasil apapun.
            </div>
        @endif
    </div>
@endsection

