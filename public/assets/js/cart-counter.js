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

// Экспортируем функцию для использования в других скриптах
window.updateCartCounter = updateCartCounter; 