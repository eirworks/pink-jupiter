<template>
    <div>
        <v-select :options="cities" label="name" placeholder="Ketik atau pilih kota" />
        <input type="hidden" name="city_id" v-model="form.city" />
    </div>
</template>

<script>
    import axios from "axios";

    const citiesUrl = document.querySelector('meta[name=api_cities]').getAttribute('content');

    export default {
        name: "SelectCity",

        data() {
            return {
                cities: [],

                form: {
                    city: 0,
                }
            }
        },

        props: {
            cityId: {
                type: Number,
                default: 0
            },
        },

        mounted() {
            this.getCities();
            this.form.city = this.cityId;
        },

        methods: {
            getCities() {
                return new Promise((resolve, reject) => {
                    axios.get(citiesUrl)
                        .then((response) => {
                            this.cities = response.data;
                            resolve();
                        })
                })
            },
        }
    }
</script>

<style scoped>

</style>
