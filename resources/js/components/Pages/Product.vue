<template>
    <div>
        <v-row>
            <v-col class="d-flex shrink">
                <v-img :src="product.image" v-if="product.image" class="ma-0 mb-2 img-thumbnail" height="300" width="300"></v-img>
            </v-col>
            <v-col>
                <h1 class="text-h2 mb-3">{{ product.name }}</h1>
                <p class="body-1">{{ product.description }}</p>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: "Product",
    data() {
        return {
            product: {},
            pageLoaded: false
        }
    },
    methods: {
        getProductData() {
            this.pageLoaded = false;
            axios.get(`/products/${this.productId}`)
            .then((response) => {
                this.product = response.data.product;
                this.pageLoaded = true;
            })
        }
    },
    computed: {
        productId() {
            return this.$route.params.id;
        }
    },
    filters: {},
    watch: {},
    created() {
        this.getProductData();
    }
}
</script>

<style scoped>

</style>
