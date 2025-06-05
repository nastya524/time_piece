<?php

namespace core\models;

use services\Connect;

class Order
{
    public static function createOrder($userId, $items)
    {
        $db = Connect::Connect();

        // Считаем общую стоимость
        $totalPrice = 0;
        foreach ($items as $item) {
            $totalPrice += $item['product_price'] * $item['quantity'];
        }

        // Вставляем заказ в таблицу orders
        $userId = (int)$userId;
        $totalPrice = (int)$totalPrice;

        $sqlOrder = "INSERT INTO `order` (user_id, price, date) VALUES ($userId, $totalPrice, NOW())";
        if (!$db->query($sqlOrder)) {
            return false;
        }
        $orderId = $db->insert_id;

        // Вставляем товары в таблицу order_element
        foreach ($items as $item) {
            $productId = (int)$item['product_id'];
            $quantity = (int)$item['quantity'];
            $sqlElement = "INSERT INTO `element_order` (product_id, order_id, quantity) VALUES ($productId, $orderId, $quantity)";
            if (!$db->query($sqlElement)) {
                return false;
            }
        }

        return $orderId;
    }


}