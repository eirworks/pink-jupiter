@extends('layouts.admin')

@section('title')
    {{ $parent ? 'Kelola Sub-Kategori '.$parent->name : 'Kelola Kategori Layanan' }}
@endsection

@section('content')
    <div class="container">

        @include('includes.breadcrumb', ['bcItems' => $bcItems])

        <div class="my-2">
            <a href="{{ route('admin.categories.create', ['parent_id' => $parent ? $parent->id : null]) }}" class="btn btn-primary">Tambah Kategori</a>
            <a href="{{ route('admin.categories.upload') }}" class="ml-2">Upload CSV</a>
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
                            <th>ID</th>
                            @if($parent)
                                <th>Urutan</th>
                            @endif
                            <th>Nama Kategori</th>
                            @if(!request()->filled('parent_id'))
                            <th>Subkategori</th>
                            @endif
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                @if($parent)
                                <td>{{ $category->ordering }}</td>
                                @endif
                                <td>
                                    {{ $category->name }}
                                    @if($parent)
                                    <div class="text-muted my-2">
                                        {{ $category->description }}
                                    </div>
                                    @endif
                                </td>
                                @if(!request()->filled('parent_id'))
                                    <td>
                                        @if($category->parent_id > 0)
                                            -
                                        @else
                                            @if($category->children_count > 0)
                                            <a href="{{ route('admin.categories.index', ['parent_id' => $category->id]) }}">{{ $category->children_count }}</a>
                                            @else
                                                {{ $category->children_count }}
                                            @endif
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route('admin.categories.edit', [$category]) }}">Edit</a>
                                            @if($category->parent_id == 0)
                                            <a class="dropdown-item" href="{{ route('admin.categories.index', ['parent_id' => $category->id]) }}">Subkategori</a>
                                            @endif
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

