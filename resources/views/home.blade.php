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
                @include('listing.item')
            @endforeach
            {!! $ads->links() !!}
        @else
            <div class="text-center text-muted">
                Tidak dapat menemukan hasil apapun.
            </div>
        @endif
    </div>
@endsection
