<template>
    <div class="container">
        <div class="card">
            <div class="card-body">

                <form :action="url" method="get">

                    <div class="row">
                        <div class="col-md-6">
                            <input type="search" name="q" class="form-control" v-model="form.searchQuery" placeholder="Cari layanan">
                        </div>
                        <div class="col-md-4">
                            <input type="search" class="form-control" v-model="form.locationQuery" placeholder="Pilih lokasi" :class="{'active-search': form.city_id > 0}" @focus="onLocationFocus">
                            <input type="hidden" class="form-control" v-model="form.city_id" name="city_id">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block" type="submit">Cari</button>
                        </div>
                    </div>
                </form>



                <template v-if="showLocationLists">

                    <div class="my-2 results" v-show="!form.locationQuery.length">
                        <div v-for="province in computedProvinces" class="mb-2">
                            <div>
                                <strong>{{ province.name }}</strong>
                            </div>
                            <div class="row">
                                <div class="col-md-3 my-1" v-for="city in province.cities">
                                    <a :href="city.url">{{ city.name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-2 results">
                        <div class="row">
                            <div class="col-md-3 my-1" v-for="city in results.cities">
                                <a :href="city.url">{{ city.name }}</a>
                            </div>
                        </div>
                    </div>
                </template>

                <template v-if="showCategoryLists">
                    <div class="my-2 results" v-show="!form.categoryQuery.length">
                        <div v-for="category in computedCategories" class="mb-2">
                            <div>
                                <strong>{{ category.name }}</strong>
                            </div>
                            <div class="row">
                                <div class="col-md-3 my-1" v-for="subcategory in category.children">
                                    <a :href="category.url">{{ subcategory.name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-2 results">
                        <div class="row">
                            <div class="col-md-3 my-1" v-for="item in results.categories">
                                <a :href="item.url">{{ item.name }}</a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    const citiesUrl = document.querySelector('meta[name=api_cities]').getAttribute('content');
    const provincesUrl = document.querySelector('meta[name=api_provinces]').getAttribute('content');
    const categoriesUrl = document.querySelector('meta[name=api_categories]').getAttribute('content');
    const subcategoriesUrl = document.querySelector('meta[name=api_subcategories]').getAttribute('content');

    export default {
        name: "SearchForm",
        props: {
            url: {
                type: String,
                default: ""
            },

            catid: {
                type: Number,
                default: 0
            },

            cityid: {
                type: Number,
                default: 0
            },
            q: {
                type: String,
                default: ""
            },
        },
        data() {
            return {
                form: {
                    city_id: 0,
                    category_id: 0,

                    locationQuery: "",
                    categoryQuery: "",
                    searchQuery: "",
                },

                results: {
                    cities: [],
                    categories: [],
                },

                provinces: [],
                categories: [],
                subcategories: [],

                showLocationLists: false,
                showCategoryLists: false,
            }
        },
        computed: {
            computedProvinces() {
                this.provinces.forEach((province) => {
                    province.cities.forEach((city) => {
                        let searchParams = new URLSearchParams(window.location.search);
                        searchParams.set("city_id", city.id);
                        city.url = window.location.origin + window.location.pathname + "?" + searchParams.toString();
                    })
                });

                return this.provinces;
            },

            computedCategories() {
                this.categories.forEach((category) => {
                    let searchParams = new URLSearchParams(window.location.search);
                    searchParams.set("category_id", category.id);
                    category.url = window.location.origin + window.location.pathname + "?" + searchParams.toString();
                });

                return this.categories;
            },
        },

        mounted() {
            this.getCategories();
            this.getProvinces();

            this.getSubcategories().then(() => {
                this.initializeValues(false);
            });
            this.getCities().then(() => {
                this.initializeValues(true);
            });

            this.form.searchQuery = this.q;
        },

        methods: {
            initializeValues(checkCity = false) {
                if (checkCity)
                {
                    if (this.cityid > 0)
                    {
                        this.form.city_id = this.cityid;
                        this.cities.forEach((city) => {
                            if (city.id === this.form.city_id)
                            {
                                console.log("Location query = ", city.name);
                                this.locationQuery = city.name;
                                return;
                            }
                        })
                    }
                }
                else {
                    if (this.catid > 0)
                    {
                        this.form.category_id = this.catid;
                        this.subcategories.forEach((category) => {
                            if (category.id === this.form.category_id)
                            {
                                console.log("category query = ", category.name);
                                this.categoryQuery = category.name;
                                return;
                            }
                        })
                    }
                }
            },

            getProvinces() {
                axios.get(provincesUrl)
                .then((response) => {
                    this.provinces = response.data;
                })
            },

            getCities() {
                return new Promise((resolve, reject) => {
                    axios.get(citiesUrl)
                        .then((response) => {
                            this.cities = response.data;
                            resolve();
                        })
                })
            },

            getCategories() {
                axios.get(categoriesUrl)
                .then((response) => {
                    this.categories = response.data;
                })
            },

            getSubcategories() {
                return new Promise(resolve => {
                    axios.get(subcategoriesUrl)
                        .then((response) => {
                            this.subcategories = response.data;
                            resolve();
                        })
                })
            },

            selectLocation(item) {
                this.form.city_id = item.id;
                this.form.locationQuery = item.name;
            },

            selectCategory(item) {
                this.form.category_id = item.id;
                this.form.categoryQuery = item.name;
            },

            onLocationFocus() {
                this.resetFocus();
                this.showLocationLists = true;
            },

            onCategoryFocus() {
                this.resetFocus();
                this.showCategoryLists = true;
            },

            resetFocus() {
                this.showLocationLists = false;
                this.showCategoryLists = false;
            },
        },

        watch: {
            'form.locationQuery': function() {
                this.results.cities = this.cities
                    .filter((city) => {
                        return city.name.toLowerCase().includes(this.form.locationQuery.toLowerCase());
                    });

                this.results.cities.forEach((city) => {
                    let searchParams = new URLSearchParams(window.location.search);
                    searchParams.set("city_id", city.id);
                    city.url = window.location.origin + window.location.pathname + "?" + searchParams.toString();
                })


            },

            'form.categoryQuery': function() {
                this.results.categories = this.subcategories.filter((subcategory) => {
                    return subcategory.name.toLowerCase().includes(this.form.categoryQuery.toLowerCase());
                });

                this.results.categories.forEach((category) => {
                    let searchParams = new URLSearchParams(window.location.search);
                    searchParams.set("category_id", category.id);
                    category.url = window.location.origin + window.location.pathname + "?" + searchParams.toString();
                })
            },
        }
    }
</script>

<style lang="scss">
    .results {
        max-height: 400px;
        overflow-x: hidden;
        overflow-y: auto;
    }

    .active-search {
        border: 2px solid black;
        color: black;
    }
</style>
