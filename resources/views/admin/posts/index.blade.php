@extends('layouts.app')

@section('title')
    Kelola Artikel
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>
        <div class="card">
            <div class="card-body">
                <div class="my-2"><a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Tulis Artikel</a></div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Dipublikasikan</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
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
                                        <a class="dropdown-item" href="#">Baca</a>
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

