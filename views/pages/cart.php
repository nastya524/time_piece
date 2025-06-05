<?php
$userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 'null';
?>
<script>
    window.userId = <?= json_encode($userId); ?>;
</script>
<script src="public/assets/js/cart-view.js"></script>
<main class="content">
    <section class="section container">
        <div class="section__body" style="padding: 0">
            <h1 class="cart__title">Корзина</h1>
            <div class="cart">
                <div class="cart-container">
                    <div class="products">

                    </div>
                    <div class="summary">
                        <div class="summary-general">
                            <p><span style="font-weight: bold;">0 товаров</span><span>0 р</span></p>
                            <p><span style="font-weight: bold;">Доставка</span> <span>Бесплатно</span></p>
                            <p><span style="font-weight: bold;">Итого</span> <span>0 р</span></p>
                            <form id="checkoutForm" method="POST" action="/checkout">
                                <input type="hidden" id="user_id" name="user_id" value="<?= $userId ?>">
                                <input type="hidden" id="cartData" name="cart_data" value="">
                                <button type="button" class="checkout">Оформить заказ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Модальное окно оформления заказа -->
<div id="checkoutModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Оформление заказа</h2>
        <form id="orderForm">
            <div class="form-section">
                <h3>Способ доставки</h3>
                <div class="delivery-options">
                    <label>
                        <input type="radio" name="delivery" value="pickup" checked>
                        Самовывоз из пункта выдачи
                    </label>
                    <label>
                        <input type="radio" name="delivery" value="courier">
                        Курьерская доставка
                    </label>
                </div>
                <div id="addressFields" style="display: none;">
                    <input type="text" name="address" placeholder="Адрес доставки" class="form-input">
                </div>
            </div>

            <div class="form-section">
                <h3>Способ оплаты</h3>
                <div class="payment-options">
                    <label>
                        <input type="radio" name="payment" value="card_courier" checked>
                        Банковской картой курьеру
                    </label>
                    <label>
                        <input type="radio" name="payment" value="cash_courier">
                        Наличными курьеру
                    </label>
                </div>
            </div>

            <div class="form-section">
                <h3>Комментарий к заказу</h3>
                <textarea name="comment" placeholder="Добавьте комментарий к заказу" class="form-input"></textarea>
            </div>

            <div class="order-summary">
                <h3>Итого к оплате</h3>
                <p class="total-amount">0 р</p>
            </div>

            <button type="submit" class="submit-order">Подтвердить заказ</button>
        </form>
    </div>
</div>

<style>
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    overflow-y: auto;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    border-radius: 8px;
    position: relative;
    max-height: 90vh;
    overflow-y: auto;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: black;
}

.form-section {
    margin-bottom: 20px;
}

.form-section h3 {
    margin-bottom: 10px;
}

.delivery-options, .payment-options {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.form-input {
    width: 100%;
    padding: 8px;
    margin: 5px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

textarea.form-input {
    min-height: 100px;
    resize: vertical;
}

.order-summary {
    margin: 20px 0;
    padding: 15px;
    background-color: #f8f8f8;
    border-radius: 4px;
}

.total-amount {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

.submit-order {
    width: 100%;
    padding: 12px;
    background-color: #000;
    color: #fff;
    border: 1px solid #000;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.3s ease;
}

.submit-order:hover {
    background-color: #fff;
    color: #000;
}
</style>