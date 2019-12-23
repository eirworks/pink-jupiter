@extends('layouts.app')

@section('type')
    {{ request()->has('page') ? 'Halaman' : 'Artikel' }}
@endsection

@section('reverse-type')
    {{ request()->has('page') ? 'Artikel' : 'Halaman' }}
@endsection

@section('title')
    Kelola @yield('type')
@endsection

@section('content')
    <div class="container my-3">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Beranda Admin</a></li>
            <li class="breadcrumb-item">@yield('title')</li>
        </ul>
        <h2>@yield('title')</h2>
        <div class="card">
            <div class="card-body">
                <div class="my-2 btn-group">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Tulis @yield('type')</a>
                    <a href="{{ route('admin.posts.create', ['page' => '1']) }}" class="btn btn-outline-secondary">Buat @yield('reverse-type')</a>
                </div>
                <div class="my-2 btn-group mx-2">
                    @if(request()->has('page'))
                        <a href="{{ route('admin.posts.index') }}">Kelola Artikel</a>
                    @else
                        <a href="{{ route('admin.posts.index', ['page' => 1]) }}">Kelola Halaman</a>
                    @endif
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        @if(!request()->has('page'))
                            <th>Kategori</th>
                        @endif
                        <th>Dipublikasikan</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>
                                @include('includes.article_link')
                            </td>
                            @if(!request()->has('page'))
                                <td>@include('admin.posts._category')</td>
                            @endif
                            <td>
                                @include('admin.posts._published')
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="triggerId"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Opsi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="{{ route('admin.posts.edit', [$post]) }}">Edit</a>
                                        <a class="dropdown-item" onclick="$('#publish-{{ $post->id }}').submit()">{{ $post->published_at ? 'Jadikan draft' : 'Publikasikan' }}</a>
                                        <a class="dropdown-item text-danger"  onclick="$('#delete-{{ $post->id }}').submit()">Hapus</a>
                                    </div>
                                    <form action="{{ route('admin.posts.publish', [$post]) }}" method="post" id="publish-{{ $post->id }}">@csrf @method('put')</form>
                                    <form action="{{ route('admin.posts.delete', [$post]) }}" method="post" id="delete-{{ $post->id }}">@csrf @method('delete')</form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

