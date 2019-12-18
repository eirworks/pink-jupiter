<div class="header-container">
    <div class="container">
        <div class="hp-title">{{ setting('homepage_title', env('APP_NAME')) }}</div>
        <div class="hp-subtitle">{{ setting('homepage_subtitle') }}</div>
        <div class="card my-2">
            <div class="card-body">
                <form action="{{ route('listing.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4 mx-0">
                                    <select class="form-control" id="province">
                                        <option value="0">Pilih Provinsi</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}" {{ request()->input('province_id') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mx-0">
                                    <select class="form-control" name="city_id">
                                        @if(!$cities)
                                            <option value="">Silakan Pilih Provinsi</option>
                                        @else
                                            <option value="">Pilih kota:</option>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-4 mx-0">
                                    <select class="form-control" name="category_id">
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
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block">Cari Layanan</button>
                        </div>
                    </div>
                </form>

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
