<div class="header-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-2">
                    <div class="card-body">
                        <form action="{{ route('listing.index') }}" method="get" class="my-0" id="search-form">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 mx-0">
                                            <select class="form-control" name="category_id" onchange="document.getElementById('search-form').submit()">
                                                <option value="">Pilih Layanan</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @if($category->children)
                                                        @foreach($category->children as $subCategory)
                                                            <option value="{{ $subCategory->id }}">--- {{ $subCategory->name }}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('bottom_script')
    <script src="{{ asset('js/hpsearch.js') }}"></script>
@endpush

@push('headers')
    <meta name="hp_search_province_url" content="{{ route('home', ['province_id' => "X"]) }}">
@endpush
