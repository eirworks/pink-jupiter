@extends('layouts.app')

@section('title')
    {{ $post->id ? 'Edit '.$post->title : 'Tulis Artikel' }}
@endsection

@section('content')
    <div class="container my-3">
        <h2>@yield('title')</h2>
        <form action="{{ $post->id ? route('admin.posts.update', [$post]) : route('admin.posts.store') }}" method="post" id="form">
            @csrf
            @if($post->id) @method('put') @endif
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" name="title" placeholder="Judul Posting"
                                       value="{{ $post->title }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <textarea name="content" rows="15" class="form-control"  id="summernote-editor">{{ $post->content }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <button type="submit" id="submit" class="btn btn-primary btn-block mb-3">Simpan</button>

                            <div class="form-check">
                                <input type="checkbox" id="publish" class="form-check-input" name="publish" value="1" {{ $post->published_at ? 'checked' : '' }}>
                                <label for="publish" class="form-check-label">Publikasikan artikel</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('external-script-src')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>
@endpush
