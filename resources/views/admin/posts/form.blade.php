@extends('layouts.admin')

@section('title')
    {{ $post->id ? 'Edit '.$post->title : 'Tulis '.(request()->has('page') ? 'Halaman' : 'Posting') }}
@endsection

@php
$seoItems = [
    'seo_description' => 'Meta: Deskripsi',
    'seo_keywords' => 'Meta: Kata kunci/keywords',
    'seo_og:title' => 'Open Graph: Judul, biarkan kosong akan diisi oleh judul postingan/halaman',
    'seo_og:description' => 'Open Graph: Deskripsi',
];
@endphp

@section('content')
    <div class="container my-3">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Beranda Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Kelola Postingan</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2>@yield('title')</h2>
        <form action="{{ $post->id ? route('admin.posts.update', [$post]) : route('admin.posts.store') }}" method="post" id="form">
            @csrf
            @if(request()->has('page'))
                <input type="hidden" name="page" value="1">
            @endif
            @if($post->id) @method('put') @endif
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" name="title" placeholder="Judul"
                                       value="{{ $post->title }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <textarea name="content" rows="15" class="form-control"  id="summernote-editor">{{ $post->content }}</textarea>
                            </div>

                            <div class="form-group">
                                <input type="text" value="{{ $post->slug }}" name="slug" class="form-control" placeholder="URL">
                            </div>
                        </div>
                    </div>

                    <div class="card my-3">
                        <div class="card-header">SEO</div>
                        <div class="card-body">
                            @foreach($seoItems as $seo => $seoInfo)
                                <div class="form-group">
                                    <input type="text" value="{{ collect($post->data)->get($seo) }}" name="data[{{ $seo }}]" class="form-control" placeholder="{{ $seoInfo }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">

                            @if((!$post->id && !request()->has('page')))
                                <div class="form-group">
                                    <label for="category_id">Pilih kategori</label>
                                    <select name="post_category_id" id="category_id" class="form-control">
                                        <option value="0">Tanpa Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                        <option value="-1">Kategori Baru</option>
                                    </select>
                                </div>

                                <div class="form-group" id="new-category">
                                    <label for="new-category">Atau buat kategori baru</label>
                                    <input type="text" name="category_name" class="form-control" placeholder="Nama kategori baru">
                                </div>
                            @endif

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
