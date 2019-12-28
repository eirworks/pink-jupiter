@extends('layouts.app')

@section('title')
    Pencarian Mitra
@endsection

@section('content')
    <div class="container">

        <div class="card mb-5">
            <div class="card-body">
                <form action="{{ route('listing.index') }}">
                    <div class="row">
                        <div class="col-md-5">
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <optgroup label="{{ $category->name }}">
                                        @foreach($category->children as $subCategory)
                                            <option value="{{ $subCategory->id }}" {{ $subCategory->id == request()->input('category_id') ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <select name="city_id" id="" class="form-control">
                                @foreach($provinces as $province)
                                    <optgroup label="{{ $province->name }}">
                                        @foreach($province->cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
{{--                                    {{ strlen($user->description) > 140 ? substr($user->description, 0, 140)."..." : $user->description }}--}}
                                    {{ $user->description }}
                                </div>

                                @if(request()->filled('category_id'))
                                    <div class="btn-group mt-3">
                                        <a class="btn btn-outline-primary" href="{{ route('listing.contact.wa', [$user, request()->input('category_id') ]) }}" target="_blank">Whatsapp</a>
                                        @if($user->contact_telegram)
                                            <a class="btn btn-outline-primary" href="{{ route('listing.contact.tg', [$user, request()->input('category_id') ]) }}" target="_blank">Telegram</a>
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

