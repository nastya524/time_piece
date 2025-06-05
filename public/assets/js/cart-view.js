// Определяем userId в глобальной области видимости
let userId = window.userId || 'null';

document.addEventListener("DOMContentLoaded", () => {
    // Получаем или создаем временный ID для неавторизованного пользователя
    let currentUserId = userId;
    if (currentUserId === 'null') {
        // Проверяем, есть ли уже сохраненный временный ID
        currentUserId = localStorage.getItem('tempUserId');
        if (!currentUserId) {
            // Если нет, создаем новый и сохраняем
            currentUserId = 'temp_' + Math.random().toString(36).substr(2, 9);
            localStorage.setItem('tempUserId', currentUserId);
        }
    }

    const cartContainer = document.querySelector(".products");
    const summaryContainer = document.querySelector(".summary-general");

    // Извлекаем корзину из Local Storage
    const cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Фильтруем товары по ID пользователя
    const userCart = cart.filter(item => item.userId === currentUserId);

    // Если корзина пуста, отображаем сообщение
    if (userCart.length === 0) {
        cartContainer.innerHTML = "<h2>Ваша корзина пуста!</h2>";
        return;
    }

    // Генерация HTML для каждого товара
    cartContainer.innerHTML = ""; // Очищаем контейнер перед заполнением
    let totalQuantity = 0;
    let totalPrice = 0;

    userCart.forEach(item => {
        totalQuantity += item.quantity;
        totalPrice += item.quantity * item.productPrice;

        const productElement = `
            <div class="product" data-id="${item.productId}">
                <img src="${item.imgPath}" alt="${item.productName}">
                <div class="info">
                    <h2 style="font-size: 20px; width: 250px">${item.productName}</h2>
                    <div class="quantity">
                        <label style="font-size: 15px; padding-bottom: 20px">Количество</label>
                        <div class="quantity-number">
                            <input type="number" value="${item.quantity}" min="1" max="${item.amountProduct}" data-id="${item.productId}">
                            <span> шт.</span>
                        </div>
                    </div>
                    <div class="price">
                        <label style="font-size: 15px; padding-bottom: 20px">Итого</label>
                        <span style="font-size: 20px; font-weight: bold" class="total-price">${item.productPrice * item.quantity} р</span>
                    </div>
                </div>
                <button class="remove" data-id="${item.productId}">✖</button>
            </div>
        `;

        cartContainer.insertAdjacentHTML("beforeend", productElement);
    });

    // Обновление итогов
    summaryContainer.innerHTML = `
        <p><span style="font-weight: bold;">${totalQuantity} товара(ов)</span><span>${totalPrice} р</span></p>
        <p><span style="font-weight: bold;">Доставка</span> <span>Бесплатно</span></p>
        <p><span style="font-weight: bold;">Итого</span> <span>${totalPrice} р</span></p>
        <form id="checkoutForm" method="POST" action="/checkout">
            <input type="hidden" id="user_id" name="user_id" value="${userId}">
            <input type="hidden" id="cartData" name="cart_data" value="">
            <button type="submit" class="checkout">Оформить заказ</button>
        </form>
    `;

    // Обработчик изменения количества товара
    document.querySelectorAll(".quantity input").forEach(input => {
        input.addEventListener("input", (event) => {
            const productId = parseInt(input.getAttribute("data-id"));
            const newQuantity = parseInt(input.value);

            updateCartQuantity(productId, newQuantity);
        });
    });

    // Обработчик удаления товара из корзины
    document.querySelectorAll(".remove").forEach(button => {
        button.addEventListener("click", () => {
            const productId = parseInt(button.getAttribute("data-id"));
            removeFromCart(productId);
        });
    });

    // Функция обновления количества товара
    function updateCartQuantity(productId, newQuantity) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const item = cart.find(item => item.productId === productId && item.userId === currentUserId);

        if (item) {
            if (newQuantity <= item.amountProduct && newQuantity >= 1) {
                item.quantity = newQuantity;
                localStorage.setItem("cart", JSON.stringify(cart));
                updateProductPrice(productId, newQuantity);
            } else {
                alert("Вы не можете добавить больше, чем есть в наличии!");
                return;
            }
        }
    }

    // Обновление отображения цены для конкретного товара
    function updateProductPrice(productId, newQuantity) {
        const productElement = document.querySelector(`.product[data-id="${productId}"]`);
        const priceElement = productElement.querySelector(".total-price");

        // Обновляем цену товара
        const product = cart.find(item => item.productId === productId && item.userId === currentUserId);
        priceElement.textContent = `${product.productPrice * newQuantity} р`;

        // Обновляем общую сумму
        updateTotalSummary();
    }

    // Функция удаления товара
    function removeFromCart(productId) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart = cart.filter(item => !(item.productId === productId && item.userId === currentUserId));
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
    }

    // Функция рендеринга корзины
    function renderCart() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        const userCart = cart.filter(item => item.userId === currentUserId);

        cartContainer.innerHTML = ""; // Очищаем корзину перед рендером
        let totalQuantity = 0;
        let totalPrice = 0;

        userCart.forEach(item => {
            totalQuantity += item.quantity;
            totalPrice += item.quantity * item.productPrice;

            const productElement = `
                <div class="product" data-id="${item.productId}">
                    <img src="${item.imgPath}" alt="${item.productName}">
                    <div class="info">
                        <h2 style="font-size: 20px">${item.productName}</h2>
                        <div class="quantity">
                            <label style="font-size: 15px">Количество</label>
                            <div class="quantity-number">
                                <input type="number" value="${item.quantity}" min="1" max="${item.amountProduct}" data-id="${item.productId}">
                                <span> шт.</span>
                            </div>
                        </div>
                        <div class="price">
                            <label style="font-size: 15px">Итого</label>
                            <span style="font-size: 20px; font-weight: bold" class="total-price">${item.productPrice * item.quantity} р</span>
                        </div>
                    </div>
                    <button class="remove" data-id="${item.productId}">✖</button>
                </div>
            `;

            cartContainer.insertAdjacentHTML("beforeend", productElement);
        });

        updateTotalSummary();
    }

    // Функция обновления итоговой суммы
    function updateTotalSummary() {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const userCart = cart.filter(item => item.userId === currentUserId);

        let totalQuantity = 0;
        let totalPrice = 0;

        userCart.forEach(item => {
            totalQuantity += item.quantity;
            totalPrice += item.quantity * item.productPrice;
        });

        summaryContainer.innerHTML = `
            <p><span style="font-weight: bold;">${totalQuantity} товара(ов)</span><span>${totalPrice} р</span></p>
            <p><span style="font-weight: bold;">Доставка</span> <span>Бесплатно</span></p>
            <p><span style="font-weight: bold;">Итого</span> <span>${totalPrice} р</span></p>
            <form id="checkoutForm" method="POST" action="/checkout">
                <input type="hidden" id="user_id" name="user_id" value="${userId}">
                <input type="hidden" id="cartData" name="cart_data" value="">
                <button type="submit" class="checkout">Оформить заказ</button>
            </form>
        `;
    }

    if (document.querySelector(".checkout")) {
        document.querySelector(".checkout").addEventListener("click", (event) => {
            event.preventDefault();

            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const userCart = cart.filter(item => item.userId === currentUserId);

            if (userCart.length === 0) {
                alert("Ваша корзина пуста!");
                return;
            }

            // Если пользователь не авторизован, перенаправляем на страницу входа
            if (userId === 'null') {
                // Сохраняем текущую корзину перед перенаправлением
                localStorage.setItem('tempCart', JSON.stringify(userCart));
                window.location.href = '/log-in';
                return;
            }

            // Показываем модальное окно
            const modal = document.getElementById('checkoutModal');
            modal.style.display = "block";

            // Обновляем итоговую сумму в модальном окне
            const totalAmount = userCart.reduce((sum, item) => sum + (item.quantity * item.productPrice), 0);
            document.querySelector('.total-amount').textContent = `${totalAmount} р`;

            // Обработчик закрытия модального окна
            const closeBtn = document.querySelector('.close');
            closeBtn.onclick = function() {
                modal.style.display = "none";
            }

            // Закрытие модального окна при клике вне его
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            // Обработчик изменения способа доставки
            document.querySelectorAll('input[name="delivery"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const addressFields = document.getElementById('addressFields');
                    addressFields.style.display = this.value === 'courier' ? 'block' : 'none';
                });
            });

            // Обработчик отправки формы заказа
            document.getElementById('orderForm').addEventListener('submit', function(e) {
                e.preventDefault();

                // Собираем данные формы
                const formData = new FormData(this);
                const orderData = {
                    delivery: formData.get('delivery'),
                    payment: formData.get('payment'),
                    comment: formData.get('comment'),
                    address: formData.get('address')
                };

                // Подготовка данных корзины
                const cartData = userCart.map(item => {
                    return `${item.productId}:${item.quantity}:${item.productPrice}`;
                }).join(",");

                // Отправляем данные на сервер
                fetch('/cart/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        'user_id': userId,
                        'cart_data': cartData,
                        'order_data': JSON.stringify(orderData)
                    })
                })
                .then(response => {
                    if (response.ok) {
                        // Очищаем корзину
                        const updatedCart = cart.filter(item => item.userId !== currentUserId);
                        localStorage.setItem('cart', JSON.stringify(updatedCart));

                        // Закрываем модальное окно
                        modal.style.display = "none";

                        // Показываем уведомление
                        alert('Заказ успешно оформлен!');

                        // Обновляем отображение корзины
                        updateCartCounter();
                        renderCart();
                    } else {
                        throw new Error('Ошибка при оформлении заказа');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Произошла ошибка при оформлении заказа. Пожалуйста, попробуйте еще раз.');
                });
            });
        });
    }

    // Функция для проверки и восстановления корзины после авторизации
    function checkAndRestoreCart() {
        const tempCart = localStorage.getItem('tempCart');
        if (tempCart && userId !== 'null') {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const tempCartItems = JSON.parse(tempCart);
            
            // Обновляем userId для всех товаров во временной корзине
            tempCartItems.forEach(item => {
                item.userId = userId;
            });
            
            // Добавляем товары из временной корзины в основную
            const updatedCart = [...cart, ...tempCartItems];
            localStorage.setItem('cart', JSON.stringify(updatedCart));
            
            // Очищаем временную корзину
            localStorage.removeItem('tempCart');
            
            // Обновляем отображение корзины
            updateCartCounter();
            if (window.location.pathname === '/cart') {
                renderCart();
            }
        }
    }

    // Проверяем корзину при загрузке страницы
    checkAndRestoreCart();
    updateCartCounter();
});

function addToCart(productId, productName, productPrice, userId, imgPath, amountProduct) {
    // Получаем текущую корзину из Local Storage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // Получаем или создаем ID пользователя
    let currentUserId = userId;
    if (currentUserId === 'null') {
        // Проверяем, есть ли уже сохраненный временный ID
        currentUserId = localStorage.getItem('tempUserId');
        if (!currentUserId) {
            // Если нет, создаем новый и сохраняем
            currentUserId = 'temp_' + Math.random().toString(36).substr(2, 9);
            localStorage.setItem('tempUserId', currentUserId);
        }
    }

    // Проверяем, есть ли уже этот товар в корзине
    let existingItem = cart.find(item => (item.productId === productId && item.userId === currentUserId));

    if (existingItem) {
        // Если товар уже есть в корзине, проверяем лимит
        if (existingItem.quantity < amountProduct) {
            existingItem.quantity += 1; // Увеличиваем количество на 1
            alert('Товар добавлен в корзину!');
        } else {
            alert('Нельзя добавить больше товара, чем есть в наличии!');
        }
    } else {
        // Если товара еще нет в корзине, добавляем его с quantity = 1
        cart.push({
            productId: productId,
            productName: productName,
            productPrice: productPrice,
            userId: currentUserId,
            imgPath: imgPath,
            quantity: 1, // Начальное количество
            amountProduct: amountProduct
        });
        alert('Товар добавлен в корзину!');
    }
    
    // Сохраняем обновленную корзину в Local Storage
    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Обновляем счетчик корзины
    updateCartCounter();
}

// Функция для обновления счетчика корзины
function updateCartCounter() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartCounter = document.getElementById('cartCounter');
    if (cartCounter) {
        // Получаем или создаем временный ID для неавторизованного пользователя
        let tempUserId = userId;
        if (tempUserId === 'null') {
            tempUserId = localStorage.getItem('tempUserId');
            if (!tempUserId) {
                tempUserId = 'temp_' + Math.random().toString(36).substr(2, 9);
                localStorage.setItem('tempUserId', tempUserId);
            }
        }
        
        // Считаем только товары текущего пользователя
        const userCart = cart.filter(item => item.userId === tempUserId);
        const totalItems = userCart.reduce((sum, item) => sum + item.quantity, 0);
        cartCounter.textContent = totalItems > 0 ? totalItems : '';
    }
}

// Вызываем обновление счетчика при загрузке страницы
document.addEventListener('DOMContentLoaded', updateCartCounter);

function checkout() {
    const modal = document.getElementById('checkoutModal');
    const cartData = localStorage.getItem('cart_' + userId) || '';
    
    // Собираем данные формы
    const formData = {
        delivery: document.querySelector('input[name="delivery"]:checked').value,
        payment: document.querySelector('input[name="payment"]:checked').value,
        address: document.getElementById('address').value,
        comment: document.getElementById('comment').value
    };

    // Отправляем данные на сервер
    fetch('/cart/checkout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'user_id': userId,
            'cart_data': cartData,
            'order_data': JSON.stringify(formData)
        })
    })
    .then(response => {
        if (response.redirected) {
            window.location.href = response.url;
        } else {
            throw new Error('Ошибка при оформлении заказа');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Произошла ошибка при оформлении заказа. Пожалуйста, попробуйте еще раз.');
    });
}

// Создаем модальное окно
const modal = document.createElement('div');
modal.id = 'checkoutModal';
modal.className = 'modal';
modal.innerHTML = `
    <div class="modal-content" style="margin-top: 5%; max-height: 90vh; overflow-y: auto;">
        <span class="close">&times;</span>
        <h2>Оформление заказа</h2>
        <form id="orderForm">
            <div class="form-group">
                <h3>Способ доставки</h3>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="delivery" value="pickup" checked>
                        Самовывоз
                    </label>
                    <label>
                        <input type="radio" name="delivery" value="courier">
                        Курьерская доставка
                    </label>
                </div>
            </div>

            <div id="addressFields" style="display: none;">
                <div class="form-group">
                    <h3>Адрес доставки</h3>
                    <input type="text" id="address" name="address" placeholder="Введите адрес доставки">
                </div>
            </div>

            <div class="form-group">
                <h3>Способ оплаты</h3>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="payment" value="card_courier" checked>
                        Оплата картой курьеру
                    </label>
                    <label>
                        <input type="radio" name="payment" value="cash_courier">
                        Оплата наличными курьеру
                    </label>
                </div>
            </div>

            <div class="form-group">
                <h3>Комментарий к заказу</h3>
                <textarea id="comment" name="comment" placeholder="Введите комментарий к заказу"></textarea>
            </div>

            <div class="form-group">
                <h3>Итоговая сумма: <span class="total-amount">0 р</span></h3>
            </div>

            <button type="submit" class="checkout-button">Подтвердить заказ</button>
        </form>
    </div>
`;