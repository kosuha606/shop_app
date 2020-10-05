<?php

/** @var $products */

?>
<div>
    <h2>Магазин</h2>
    <div class="form-row">
        <button @click="generateProducts" class="btn">Сгенерировать товары</button>
    </div>
    <hr>
    Id товаров нового заказа: {{ Object.keys(productIdsForOrder) }}
    <div v-if="Object.keys(productIdsForOrder).length > 0">
        <button class="btn" @click="createNewOrder">Создать заказ</button>
    </div>
    <template v-if="order.total">
        <hr>
        <b>Оформление заказа</b>
        <div class="form-row">
            <div>
                К оплате: {{ order.total }} руб.
            </div>
            <button class="btn" @click="payCurrentOrder">Оплатить заказ</button>
        </div>
    </template>
</div>

<hr>

<div>
    <product-item :product="product" v-for="product in products"></product-item>
</div>