<template>
    <v-container>
        <v-row>
            <v-col>
                {{ product }}
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import axios from 'axios';

export default {
    name: "EditProduct",
    data() {
        return {
            product: {}
        }
    },
    methods: {
        getProductData(productId) {
            axios.get('/products/'+productId)
            .then((response) => {
                this.product = response.data.product;
            });
        },
        updateProduct() {
            axios.put('/products/'+this.product.id)
            .then((response) => {

            });
        }
    },
    computed: {},
    filters: {},
    watch: {},
    created() {
        this.getProductData(this.$route.params.id);
    }
}
</script>

<style scoped>

</style>
