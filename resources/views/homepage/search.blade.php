<div class="header-container" id="fp-search">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card my-2">
                    <div class="card-body">
                        <form action="{{ route('listing.index') }}" method="get" class="my-0" id="search-form">
                            <div class="row">
                                <div class="col-md-3 px-1">
                                    <input type="text" v-model="locationQuery" class="form-control hp-select-service" placeholder="Cari Lokasi" @focus="showCatalogs = !showCatalogs" >
                                    <input type="text" v-model="form.city_id" name="city_id" class="form-control">
                                </div>
                                <div class="col-md-8 px-1" id="hp-services-container">
                                    <div>
                                        <input v-model="query" @focus="showCatalog()"  class="form-control hp-select-service" type="text" placeholder="Pilih Layanan">
                                        <input type="text" v-model="form.category_id" name="category_id" class="form-control">
                                    </div>

                                    <div class="hp-services" id="hp-services-content" v-if="showCatalogs && !query.length">
                                        @foreach($categories as $category)
                                            <div class="mt-2"><strong>{{ $category->name }}</strong></div>
                                            @if($category->children)
                                                @foreach($category->children->chunk(2) as $subCategoryChunk)
                                                    <div class="row">
                                                        @foreach($subCategoryChunk as $subCategory)
                                                            <div class="col-12 col-md-6">
                                                                <a href="javascript:" @click="form.category_id = {{ $subCategory->id }}">{{ $subCategory->name }}</a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="hp-services-search-result" v-if="query.length">
                                        <ul class="list-unstyled" v-if="results.length">
                                            <li v-for="(item, index) in results">
                                                <a href="javascript:" @click="selectCategory(item)">@{{ item.name }}</a>
                                            </li>
                                        </ul>
                                        <div class="text-muted text-center my-3" v-else>Tidak dapat menemukan kategori dengan nama '@{{ query }}'</div>
                                    </div>
                                </div>
                                <div class="col-md-1 px-1">
                                    <button class="btn btn-primary btn-block">Cari</button>
                                </div>
                            </div>

                            <div class="location-result">
                                <div class="my-2 hp-services" v-show="showCatalogs && !locationQuery.length">
                                    @foreach($provinces as $province)
                                        <div><strong>{{ $province->name }}</strong></div>
                                        <div class="row">
                                            @foreach($province->cities as $city)
                                                <div class=""><a href="javascript:" @click="selectLocation({id: {{ $city->id }}, name: '{{ $city->name }}' })">{{ $city->name }}</a></div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <div class="my-2 hp-services" v-show="locationQuery.length">
                                    <ul class="list-unstyled">
                                        <li v-for="item in locationResults">
                                            <a href="#" @click="form.city_id = item.id">@{{ item.name }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="subcategories" class="d-none">
    {{ $subCategoriesJson }}
</div>
<div id="cities-data" class="d-none">{{ $citiesJson }}</div>

@push('headers')
    <meta name="hp_search_province_url" content="{{ route('home', ['province_id' => "X"]) }}">
    <meta name="listing_with_cat_url" content="{{ route('listing.index', ['category_id' => "XXX"]) }}">
@endpush
