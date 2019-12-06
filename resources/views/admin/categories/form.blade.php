@extends('layouts.app')

@section('title')
    {{ $category->id ? 'Edit Kategori '.$category->name : 'Buat Kategori' }}
@endsection

@section('content')
    <div class="container">
        <h2>@yield('title')</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.categories.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <input type="text" placeholder="Nama Kategori" name="name" class="form-control" value="{{ $category->name }}">
                            </div>

                            <div class="form-group">
                                <input type="text" placeholder="Slug URL" name="slug" class="form-control" value="{{ $category->slug }}">
                                <div class="text-muted">
                                    Jika dibiarkan kosong, url akan diisi secara otomatis.
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea type="text" placeholder="Deskripsi" name="description" class="form-control" rows="5">{{ $category->description }}</textarea>
                            </div>

                            <button class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.categories.index') }}" class="mx-1 btn btn-link">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

