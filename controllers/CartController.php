<?php

class CartController
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function checkout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Проверяем авторизацию пользователя
            if (!isset($_SESSION['user'])) {
                // Если пользователь не авторизован, перенаправляем на страницу входа
                header('Location: /log-in');
                exit;
            }

            $userId = $_SESSION['user']['id'];
            $cartData = $_POST['cart_data'] ?? '';

            if (empty($cartData)) {
                $_SESSION['error'] = 'Корзина пуста';
                header('Location: /cart');
                exit;
            }

            // Разбираем данные корзины
            $items = explode(',', $cartData);
            $orderItems = [];

            foreach ($items as $item) {
                list($productId, $quantity, $price) = explode(':', $item);
                $orderItems[] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $price
                ];
            }

            // Создаем заказ
            $orderId = $this->orderModel->createOrder($userId, $orderItems);

            if ($orderId) {
                // Очищаем корзину пользователя из localStorage через JavaScript
                echo "<script>
                    let cart = JSON.parse(localStorage.getItem('cart')) || [];
                    cart = cart.filter(item => item.userId !== '" . $userId . "');
                    localStorage.setItem('cart', JSON.stringify(cart));
                    window.location.href = '/profile';
                </script>";
                exit;
            } else {
                $_SESSION['error'] = 'Ошибка при оформлении заказа';
                header('Location: /cart');
                exit;
            }
        }
    }
} 