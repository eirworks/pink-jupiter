@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="typeofad">{{ $type }}</h2>

        <div class="card">
            <div class="card-body">
                <form action="" method="get">

                    <div class="row">
                        <div class="col-md">
                            <select name="city_id" id="city_id" class="form-control">
                                <option value="">{{ __('ads.select_city') }}</option>
                                @foreach($provinces as $province)
                                    <optgroup label="{{ $province->name }}">
                                        @foreach($province->cities as $item)
                                            <option value="{{ $item->id }}" {{ request()->input('city_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md">
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">{{ __('ads.select_category') }}</option>
                                @foreach($categories as $item)
                                    <option value="{{ $item->id }}" {{ request()->input('category_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-primary">{{ __('ads.search_ads') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="container">
        @isset($category)
            <div class="card my-2">
                <div class="card-body">
                    <strong>{{ $category->name }}</strong>:
                    {{ $category->description }}
                </div>
            </div>
        @endisset

        @if($ads->count())
            <div class="row">
                @foreach($ads as $ad)
                    <div class="col-md-3 col-6">
                        @include('listing.item')
                    </div>
                @endforeach
            </div>
            {!! $ads->links() !!}
        @else
            <div class="text-center text-muted my-5">
                Tidak dapat menemukan hasil apapun.
            </div>
        @endif
    </div>
@endsection
