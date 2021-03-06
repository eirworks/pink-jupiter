@extends('layouts.admin')

@section('title')
    {{ $category->id ? 'Edit Kategori '.$category->name : 'Buat Kategori Utama' }}
    {{ $parent ? 'untuk Kategori '.$parent->name : '' }}
@endsection

@section('content')
    <div class="container">

        @include('includes.breadcrumb')

        <h2>@yield('title')</h2>
        <div class="row justify-content-center mt-3 mb-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.categories.store') }}" method="post">
                            @csrf

                            @if(request()->has('parent_id'))
                                <input type="hidden" name="parent_id" value="{{ request()->input('parent_id') }}">
                            @endif

                            <div class="form-group">
                                <label>Nama Kategori *</label>
                                <input type="text" placeholder="Nama Kategori" name="name" class="form-control" value="{{ $category->name }}">
                            </div>

                            @if($parent)
                                <div class="form-group">
                                    <label>Harga (Rp) *</label>
                                    <input type="number" min="0" placeholder="Masukkan nominal harga per klik" name="price" class="form-control" value="{{ $category->price }}">
                                </div>

                                <div class="form-group">
                                    <label>Urutan Item</label>
                                    <input type="number" min="0" placeholder="Masukkan nomor urutan" name="ordering" class="form-control" value="{{ $category->ordering }}">
                                    <div class="my-1 text-muted">
                                        (Opsional) Digunakan untuk mengurutkan saat ditampilkan di frontpage. Urutan dari kecil ke besar.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Urutan Kelompok</label>
                                    <input type="number" min="0" placeholder="Masukkan nomor urutan" name="group_order" class="form-control" value="{{ $category->group_order }}">
                                    <div class="my-1 text-muted">
                                        (Opsional) Urutan pengelompokan, item akan dikelompokkan dengan nomor urutan yang sama. Urutan kelompok diurutan terlebih dahulu sebelum Urutan Item. Urutan diurutkan dari angka terkecil hingga ke besar.
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label>URL</label>
                                <input type="text" placeholder="Slug URL" name="slug" class="form-control" value="{{ $category->slug }}">
                                <div class="text-muted my-1">
                                    Bila dibiarkan kosong, sistem akan mengisinya secara otomatis.
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tipe</label>
                                <select name="type" id="type" class="form-control">
                                    @foreach(\App\Category::categories() as $key => $name)
                                        <option value="{{ $key }}" {{ $key == $category->type ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Info (opsional)</label>
                                <textarea type="text" placeholder="Deskripsi" name="description" class="form-control" rows="5">{{ $category->description }}</textarea>
                            </div>

                            <p class="text-muted">Pastikan semua kolom ditandai dengan * sudah diisi!</p>
                            <button class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.categories.index') }}" class="mx-1 btn btn-link">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

