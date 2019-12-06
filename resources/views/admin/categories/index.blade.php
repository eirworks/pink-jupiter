@extends('layouts.app')

@section('title')
    Kelola Kategori Layanan
@endsection

@section('content')
    <div class="container">
        <div class="my-2">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Tambah Kategori</a>
        </div>

        <div class="card">
            <div class="card-body">

                <h2>@yield('title')</h2>

                @if($categories->count() == 0)
                    @include('includes.empty_list', ['itemName' => 'kategori layanan'])
                @else
                    <table class="table mb-3">
                        <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('admin.categories.edit', [$category]) }}">Edit</a>
                                            <a class="dropdown-item" href="javascript:" onclick="$('#delete-cat-{{ $category->id }}').submit()">Hapus</a>
                                        </div>
                                    </div>
                                    <form action="{{ route('admin.categories.destroy', [$category]) }}" id="delete-cat-{{ $category->id }}" method="post" class="d-none">
                                        @csrf @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $categories->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection

