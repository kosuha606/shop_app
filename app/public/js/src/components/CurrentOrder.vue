<template>
    <div>
        <b>Состав заказа:</b>
        <em v-if="products.length === 0">Нет товаров в заказе</em>
    </div>
</template>

<script>
    export default {
        name: "CurrentOrder",
        data() {
            return {
                products: []
            }
        }
    }
</script>

<style scoped>

</style>