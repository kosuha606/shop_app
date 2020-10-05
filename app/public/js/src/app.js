
import Vue from 'vue';
import axios from 'axios';
import ProductItem from "./components/ProductItem";

const app = new Vue({
    el: '#app',
    components: {
        ProductItem
    },
    data: function() {
        return {
            isRequest: false,
            products: _products,
            order: _order,
            hello: 'world',
            productIdsForOrder: {},
        };
    },
    mounted() {
        axios.interceptors.request.use((config) => {
            this.isRequest = true;
            return config;
        }, (config) => {
            this.isRequest = false;
            return config;
        });
        axios.interceptors.response.use((config) => {
            this.isRequest = false;
            return config;
        }, (config) => {
            this.isRequest = false;
            return config;
        });
    },
    methods: {
        payCurrentOrder() {
            axios.put('/api/order-complete', {
                order: this.order
            })
                .then((response) => {
                    if (response.data.result === true) {
                        alert('Заказ успешно оплачен');
                    } else {
                        alert('Ошибка оплаты, попробуйте позднее');
                    }

                    this.order = {};
                    this.productIdsForOrder = {};
                    this.$forceUpdate();
                })
            ;
        },
        createNewOrder() {
            axios.post('/api/order-create', {
                productIds: this.productIdsForOrder
            })
                .then((response) => {
                    if (response.data.result) {
                        this.order = response.data.order;
                        this.productIdsForOrder = {};
                        this.$forceUpdate();
                    }
                })
            ;
        },
        generateProducts() {
            axios.post('/api/generate', {})
                .then((response) => {
                    if (response.data.wasGenerated === true) {
                        location.reload();
                    } else {
                        alert('Данные уже сгенерированы');
                    }
                })
            ;
        }
    }
});