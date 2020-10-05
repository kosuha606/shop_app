<template>
    <div class="product-item">
        <div>
            id: {{ product.id }}
        </div>
        <div>
            <b>{{ product.name }}</b>
        </div>
        <div>
            <em>{{ product.price }} руб.</em>
        </div>
        <div v-if="!$root.productIdsForOrder[product.id]">
            <button class="btn" @click="addToOrder(product.id)">В заказ</button>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "ProductItem",
        props: ['product'],
        methods: {
            addToOrder(id) {
                this.$root.productIdsForOrder[id] = id
                this.$root.$forceUpdate();
                this.$forceUpdate();
            }
        }
    }
</script>

<style scoped>

</style>