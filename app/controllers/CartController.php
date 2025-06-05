<?php

class CartController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function checkout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Проверяем авторизацию
            if (!isset($_SESSION['user'])) {
                http_response_code(401);
                echo json_encode(['error' => 'Unauthorized']);
                exit;
            }

            $userId = $_POST['user_id'];
            $cartData = $_POST['cart_data'];
            $orderData = json_decode($_POST['order_data'], true);

            try {
                // Начинаем транзакцию
                $this->db->beginTransaction();

                // Рассчитываем общую сумму
                $totalAmount = 0;
                $cartItems = explode(',', $cartData);
                foreach ($cartItems as $item) {
                    list($productId, $quantity, $price) = explode(':', $item);
                    $totalAmount += $quantity * $price;
                }

                // Создаем заказ
                $stmt = $this->db->prepare("
                    INSERT INTO `order` (
                        user_id,
                        price,
                        delivery_method,
                        payment_method,
                        address,
                        comment,
                        status,
                        date
                    ) VALUES (?, ?, ?, ?, ?, ?, 'pending', NOW())
                ");

                $stmt->execute([
                    $userId,
                    $totalAmount,
                    $orderData['delivery'],
                    $orderData['payment'],
                    $orderData['address'] ?? null,
                    $orderData['comment'] ?? null
                ]);

                $orderId = $this->db->lastInsertId();

                // Добавляем товары заказа
                $stmt = $this->db->prepare("
                    INSERT INTO element_order (
                        order_id,
                        product_id,
                        quantity,
                        price
                    ) VALUES (?, ?, ?, ?)
                ");

                foreach ($cartItems as $item) {
                    list($productId, $quantity, $price) = explode(':', $item);
                    $stmt->execute([$orderId, $productId, $quantity, $price]);
                }

                // Завершаем транзакцию
                $this->db->commit();

                // Очищаем корзину пользователя
                $this->clearCart($userId);

                // Возвращаем успешный ответ
                http_response_code(200);
                echo json_encode(['success' => true, 'order_id' => $orderId]);
                exit;

            } catch (Exception $e) {
                // В случае ошибки откатываем транзакцию
                $this->db->rollBack();
                error_log("Error creating order: " . $e->getMessage());
                http_response_code(500);
                echo json_encode(['error' => 'Internal server error']);
                exit;
            }
        }
    }

    private function clearCart($userId) {
        // Очищаем корзину в базе данных, если она там хранится
        // В нашем случае корзина хранится в localStorage, поэтому этот метод может быть пустым
    }
} 