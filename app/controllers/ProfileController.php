<?php

class ProfileController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function index() {
        if (!isset($_SESSION['user'])) {
            header('Location: /log-in');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $orders = $this->getUserOrders($userId);

        require_once 'views/pages/profile.php';
    }

    private function getUserOrders($userId) {
        // Получаем все заказы пользователя
        $stmt = $this->db->prepare("
            SELECT o.*, 
                   GROUP_CONCAT(
                       CONCAT(
                           p.name, ':', 
                           eo.quantity, ':', 
                           eo.price, ':', 
                           p.img_path
                       )
                   ) as items_data
            FROM `order` o
            LEFT JOIN element_order eo ON o.id = eo.order_id
            LEFT JOIN product p ON eo.product_id = p.id_product
            WHERE o.user_id = ?
            GROUP BY o.id
            ORDER BY o.date DESC
        ");

        $stmt->execute([$userId]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Форматируем данные заказов
        foreach ($orders as &$order) {
            $items = [];
            if ($order['items_data']) {
                $itemsData = explode(',', $order['items_data']);
                foreach ($itemsData as $itemData) {
                    list($name, $quantity, $price, $imgPath) = explode(':', $itemData);
                    $items[] = [
                        'name' => $name,
                        'quantity' => $quantity,
                        'price' => $price,
                        'img_path' => $imgPath
                    ];
                }
            }
            $order['items'] = $items;
            unset($order['items_data']);
        }

        return $orders;
    }
} 