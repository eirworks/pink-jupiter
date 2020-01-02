const categories = JSON.parse(document.getElementById('subcategories').innerText);
const cities = JSON.parse(document.getElementById('cities-data').innerText);

export const fpSearch = new Vue({
    el: '#fp-search',

    data() {
        return {
            showCatalogs: false,
            query: "",
            locationQuery: "",
            results: [],
            locationResults: [],

            form: {
                city_id: 0,
                category_id: 0,
            },

            _cities: [],

            _searchLocationOnFocus: true,
            _searchCategoryOnFocus: true,
        }
    },

    methods: {
        showCatalog() {
            this.showCatalogs = true;
        },

        selectLocation(item) {
            this.locationQuery = item.name;
            this.form.city_id = item.id;
        },

        selectCategory(item) {
            let url = document.querySelector('meta[name=listing_with_cat_url]').getAttribute('content').replace('XXX', item.id);

            console.log("URL:", item.url);

            window.location = item.url;
        },
    },

    mounted() {
        this._cities = JSON.parse(document.getElementById('cities-data').innerText);
    },

    watch: {
        query: function() {
            this.results = categories.filter((cat) => {
                return cat.name.toLowerCase().includes(this.query);
            })
        },
        locationQuery: function() {
            this.locationResults = cities.filter((city) => {
                return city.name.toLowerCase().includes(this.locationQuery);
            })
        },
    },
});
