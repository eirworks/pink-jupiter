<template>
    <div>
        <v-select :options="categories" label="name" placeholder="Ketik atau pilih kategori layanan iklan" @input="onInput" />
        <input type="hidden" name="category_id" v-model="form.category" />
    </div>
</template>

<script>
    import axios from "axios";

    const subcategoriesUrl = document.querySelector('meta[name=api_subcategories]').getAttribute('content');
    const categoriesUrl = document.querySelector('meta[name=api_categories]').getAttribute('content');

    export default {
        name: "SelectCategory",

        data() {
            return {
                categories: [],
                subcategories: [],

                form: {
                    category: 0,
                }
            }
        },

        props: {
            categoryId: {
                type: Number,
                default: 0
            },
        },

        mounted() {
            this.getCategories();
            this.form.category = this.categoryId;
        },

        methods: {

            onInput(item) {
                this.form.category = item.id;
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
        }
    }
</script>
