@extends('layouts.app')

@isset($post)
    @section('seo_description'){{ collect($post->data)->get('seo_description') }}@endsection
    @section('seo_keywords', collect($post->data)->get('seo_keywords'))

    @push('og')
        <meta property="og:title" content="{{ collect($post->data)->get('seo_og:title', $post->title) }}">
        <meta property="og:description" content="{{ collect($post->data)->get('seo_og:description', '') }}">
    @endpush
@endisset



@section('title')
    @isset($post)
        @if($post->page)
            {{ $post->title }}
        @else
            Artikel {{ env('APP_NAME') }}
        @endif
    @endisset
@endsection

@section('content')
    <div class="container my-3">

        <div class="row">
            <div class="col-md-9">
                @if(isset($posts))
                    @if($posts->count() > 0)
                        @foreach($posts as $post)
                            <div class="post">
                                <div class="post-title" style="margin: 15px 0">
                                    @include('includes.article_link')
                                </div>
                                <div class="post-excerpt">
                                    {!! $post->content !!}
                                </div>
                            </div>
                        @endforeach
                        {!! $posts->links() !!}
                    @else
                        <div class="text-muted text-center">Tidak ada artikel</div>
                    @endif
                @else
                    <div class="post">
                        <div class="post-title">
                            {{ $post->title }}
                        </div>
                        <div class="post-meta">
                            Diposting pada {{ $post->created_at }}
                            @if($post->post_category_id > 0)
                                dalam {{ $post->category->name }}
                            @endif
                        </div>
                        <div class="post-content">
                            {!! $post->content !!}
                        </div>
                        @include('articles._sharing')
                    </div>
                @endif
            </div>
            <div class="col-md-3">
                @isset($post)
                    @if(!$post->page)
                        <form action="{{ route('articles.index') }}" method="get" id="change_category">
                            <select name="category_id" id="category_id" class="form-control" onchange="catChanged()">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request()->input('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </form>
                        <script>
                            function catChanged()
                            {
                                document.getElementById('change_category').submit();
                            }
                        </script>
                    @endif
                @endisset
            </div>
        </div>
    </div>
@endsection

