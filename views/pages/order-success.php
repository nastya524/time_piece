<?php require_once 'views/layouts/header.php'; ?>

<main class="content">
    <section class="section container">
        <div class="section__body" style="padding: 0">
            <div class="order-success">
                <h1>Заказ успешно оформлен!</h1>
                <p>Спасибо за ваш заказ. Мы свяжемся с вами в ближайшее время для подтверждения.</p>
                <div class="order-success-buttons">
                    <a href="/" class="button">Вернуться на главную</a>
                    <a href="/profile" class="button">Перейти в личный кабинет</a>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
.order-success {
    text-align: center;
    padding: 40px 20px;
}

.order-success h1 {
    margin-bottom: 20px;
    color: #000;
}

.order-success p {
    margin-bottom: 30px;
    color: #666;
}

.order-success-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
}

.order-success-buttons .button {
    padding: 12px 24px;
    background-color: #000;
    color: #fff;
    border: 1px solid #000;
    border-radius: 4px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.order-success-buttons .button:hover {
    background-color: #fff;
    color: #000;
}
</style>

<?php require_once 'views/layouts/footer.php'; ?> 