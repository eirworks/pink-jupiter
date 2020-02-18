@extends('layouts.app')

@section('content')
    <search-form url="{{ route('home') }}" q="{{ request()->input('q') }}" :catid="{{ request()->input('category_id', 0) }}" :cityid="{{ request()->input('city_id',0) }}"></search-form>

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
            <div class="text-center text-muted">
                Tidak dapat menemukan hasil apapun.
            </div>
        @endif
    </div>
@endsection
