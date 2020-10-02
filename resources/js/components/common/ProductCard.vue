<template>
    <v-card class="d-flex flex-column mb-3" min-width="400" max-width="500">
        <v-img :src="product.image" :alt="product.name" v-if="product.image" min-height="300" max-height="300"></v-img>
        <v-card-title>
            {{ product.name }}
        </v-card-title>
        <v-card-text class="flex-grow-1" v-text="product.description"></v-card-text>
        <slot name="subscription"></slot>
        <slot name="actions"></slot>
<!--        <v-card-actions>-->
<!--            <v-btn block color="blue-grey" v-if="subscribed(product.subscription)">Add</v-btn>-->
<!--            <v-btn block color="blue-grey" v-else>{{ product.price | formatMoney }}</v-btn>-->
<!--        </v-card-actions>-->
    </v-card>
</template>

<script>
export default {
name: "ProductCard",
    props: {
        product: {
            type: Object,
            required:true
        }
    },
data() {
return {}
},
methods: {},
computed: {},
filters: {},
watch: {},
created() {}
}
</script>

<style scoped>

</style>
