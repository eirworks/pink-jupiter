@extends('layouts.app')

@section('content')
    <search-form url="{{ route('home') }}" :catid="{{ request()->input('category_id', 0) }}" :cityid="{{ request()->input('city_id',0) }}"></search-form>

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
            @foreach($ads as $ad)
                <a href="{{ route('listing.show', [$ad->user_id, 'i' => $ad->id]) }}" class="d-block text-decoration-none">
                    <div class="card my-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 col-4 text-center">
                                    @if($ad->image)
                                        <img src="{{ \Storage::disk('public')->url($ad->image) }}" alt="{{ $ad->name }}" class="img-thumbnail img-fluid">
                                    @endif
                                </div>
                                <div class="col-md-10 col-8">
                                    <div>
                                        #{{ $loop->index + 1 }}
                                        <strong>{{ $ad->name }}</strong>
                                    </div>
                                    <div class="text-muted">
                                        {{ $ad->city->name }}, {{ $ad->city->province->name }}
                                    </div>

                                    <div>
                                        @include('includes.price_format', ['number' => $ad->price])
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            {!! $ads->links() !!}
        @else
            <div class="text-center text-muted">
                Tidak dapat menemukan hasil apapun.
            </div>
        @endif
    </div>
@endsection
