@extends('layouts.app')

@section('title')
    Artikel {{ env('APP_NAME') }}
@endsection

@section('content')
    <div class="container my-3">
        <h2 class="text-center">@yield('title')</h2>

        <div class="row">
            <div class="col-md-9">
                @if(isset($posts))
                    @foreach($posts as $post)
                        <div class="post">
                            <div class="post-title">
                                @include('includes.article_link')
                            </div>
                            <div class="post-excerpt">
                                {!! $post->content !!}
                            </div>
                        </div>
                    @endforeach
                    {!! $posts->links() !!}
                @else
                    <div class="post">
                        <div class="post-title">
                            {{ $post->title }}
                        </div>
                        <div class="post-meta">
                            Diposting pada {{ $post->created_at }}
                        </div>
                        <div class="post-content">
                            {{ $post->content }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection

