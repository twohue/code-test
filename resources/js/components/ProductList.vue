<template>
    <v-container v-if="pageLoaded">
        <v-row>
            <v-col>
                <v-pagination
                    v-model="page"
                    :length="totalPages"
                    total-visible="5"
                    prev-icon="mdi-menu-left"
                    next-icon="mdi-menu-right"
                    class="mb-3"
                    color="blue-grey darken-2"
                    dark
                    v-if="displayPagination"
                ></v-pagination>
            </v-col>
        </v-row>

        <v-row dense>
            <v-col v-for="product in products.data" :key="product.id" class="d-flex">
                <product-card :product="product">
                    <template v-slot:subscription="subscription">
                        <v-card-text>{{ product.subscription | includedInSubscription }}</v-card-text>
                    </template>
                    <template v-slot:actions="actions">
                        <v-card-actions>
                            <v-btn block color="blue-grey" v-if="subscribed(product.subscription)">Add</v-btn>
                            <v-btn block color="blue-grey" v-else>{{ product.price | formatMoney }}</v-btn>
                        </v-card-actions>
                    </template>
                </product-card>
            </v-col>
        </v-row>

        <v-row>
            <v-col>
                <v-pagination
                    v-model="page"
                    :length="totalPages"
                    total-visible="5"
                    prev-icon="mdi-menu-left"
                    next-icon="mdi-menu-right"
                    class="mb-3"
                    color="blue-grey darken-2"
                    dark
                    v-if="displayPagination"
                ></v-pagination>
            </v-col>
        </v-row>

    </v-container>
</template>

<script>
import axios from 'axios';
import ProductCard from "./common/ProductCard";

export default {
    name: "ProductList",
    components: {
        ProductCard
    },
    data() {
        return {
            page: 1,
            products: {
                total: 0,
                per_page: 15,
                from: 1,
                to: 0,
                current_page: 1,
                data: []
            },
            pageLoaded: false,
        }
    },
    methods: {
        getProductList() {
            axios.get(this.URL)
                .then((response) => {
                    this.products = response.data.products;
                    this.pageLoaded = true;
                });
        },
        subscribed(productSubscription) {
            if(this.user !== null) {
                return this.user.user.subscription_id >= productSubscription.id;
            } else {
                return false;
            }
        }
    },
    computed: {
        totalPages() {
            return Math.round(this.products.total / this.products.per_page ) || 0;
        },
        URL() {
            return `/products?page=${this.page}`;
        },
        displayPagination() {
            return this.products.per_page < this.products.total;
        },
        user() {
            return this.$store.state.user;
        }
    },
    filters: {
        formatMoney(val) {
            return '$'+val+'.00';
        },
        includedInSubscription(subscription) {
            let subscriptionString = 'Included in '+subscription.name+ ' Subscription';
                if(subscription.id <= 2) {
                    subscriptionString += ' and higher';
                } else {
                    subscriptionString += ' only';
                }
                return subscriptionString;
        }
    },
    watch: {
        page() {
            this.getProductList();
        }
    },
    created() {
        this.getProductList();
    }
}
</script>

<style scoped>

</style>
