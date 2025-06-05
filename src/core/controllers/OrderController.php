<?php

namespace core\controllers;

use core\models\Order;
use core\models\Product;
use services\Helper;

class OrderController
{

    public function createOrder($data)
    {
        $userId = $_POST['user_id'] ?? null;
        $cartData = $_POST['cart_data'] ?? null;

        if (empty($userId) || empty($cartData)) {
            header("Location: /cart?error=invalid_data");
            exit;
        }

        // Парсинг данных корзины
        $items = array_map(function ($item) {
            list($productId, $quantity, $productPrice) = explode(":", $item);
            return [
                'product_id' => (int)$productId,
                'quantity' => (int)$quantity,
                'product_price' => (float)$productPrice
            ];
        }, explode(",", $cartData));

        // Создаем заказ
        $orderId = Order::createOrder($userId, $items);

        if ($orderId === false) {
            header("Location: /cart?error=order_failed");
            exit;
        }

        // Обновляем количество товаров
        foreach ($items as $item) {
            if (!Product::updateProductQuantity($item['product_id'], $item['quantity'])) {
                header("Location: /cart?error=update_failed");
                exit;
            }
        }

        // Успешное завершение
        header("Location: /cart?success=order_completed");
        exit;
    }
}