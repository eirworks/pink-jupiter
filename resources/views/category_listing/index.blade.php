@extends('layouts.app')

@section('title')
    Layanan Kami
@endsection

@section('content')
    <div class="container">

        <h2>@yield('title')</h2>

        @foreach($categories as $category)
            <h4 class="my-2">{{ $category->name }}</h4>
            {{ $category->children->join(',') }}
            @foreach($category->children->chunk(3) as $subcategoryChunk)
                <div class="row">
                    @foreach($subcategoryChunk as $subcategory)
                        <div class="col-md-4">
                            <a href="{{ route('listing.categories.show', [$subcategory, $subcategory->slug]) }}">{{ $subcategory->name }}</a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endforeach
    </div>
@endsection
