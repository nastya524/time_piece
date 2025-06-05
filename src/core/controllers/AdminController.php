<?php

namespace core\controllers;

use core\models\Admin;
use services\Connect;

class AdminController
{
    public static function addDataProduct() {
        try {
            // Проверка наличия всех необходимых полей
            $required_fields = [
                'name_product', 'price', 'category_id', 'amoynt_product',
                'description', 'brand_description_id', 'country_id', 'resistance_id',
                'collection_name', 'style_id', 'mechanism_id', 'model_mechaism',
                'amount_stones', 'diametr', 'case_color_id', 'dial_color_id'
            ];

            foreach ($required_fields as $field) {
                if (!isset($_POST[$field]) || empty($_POST[$field])) {
                    die('Ошибка: поле ' . $field . ' обязательно для заполнения');
                }
            }

            // Проверка загрузки изображения
            if (!isset($_FILES['product_image']) || $_FILES['product_image']['error'] !== UPLOAD_ERR_OK) {
                die('Ошибка загрузки изображения: ' . ($_FILES['product_image']['error'] ?? 'файл не загружен'));
            }

            // Обработка загрузки изображения
            $target_dir = "public/assets/images/products/";
            $imageFileType = strtolower(pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION));
            $image_name = uniqid() . '.' . $imageFileType;
            $target_file = $target_dir . $image_name;
            
            // Проверка и загрузка изображения
            if (!move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                die('Ошибка загрузки изображения: не удалось переместить файл');
            }

            // Получение данных из формы
            $name_product = mysqli_real_escape_string(Connect::connect(), $_POST['name_product']);
            $price = (float)$_POST['price'];
            $category_id = (int)$_POST['category_id'];
            $amoynt_product = (int)$_POST['amoynt_product'];
            $description = mysqli_real_escape_string(Connect::connect(), $_POST['description']);
            $brand_description_id = (int)$_POST['brand_description_id'];
            $country_id = (int)$_POST['country_id'];
            $resistance_id = (int)$_POST['resistance_id'];
            $collection_name = mysqli_real_escape_string(Connect::connect(), $_POST['collection_name']);
            $style_id = (int)$_POST['style_id'];
            $mechanism_id = (int)$_POST['mechanism_id'];
            $model_mechaism = mysqli_real_escape_string(Connect::connect(), $_POST['model_mechaism']);
            $amount_stones = (int)$_POST['amount_stones'];
            $diametr = (float)$_POST['diametr'];
            $case_color_id = (int)$_POST['case_color_id'];
            $dial_color_id = (int)$_POST['dial_color_id'];
            
            // Формирование SQL запроса
            $query = "INSERT INTO `product` (
                `name_product`, 
                `price`, 
                `category_id`,
                `amoynt_product`,
                `description`,
                `brand_description_id`,
                `country_id`,
                `resistance_id`,
                `collection_name`,
                `style_id`,
                `mechanism_id`,
                `model_mechaism`,
                `amount_stones`,
                `diametr`,
                `case_color_id`,
                `dial_color_id`,
                `img_path`
            ) VALUES (
                '$name_product',
                $price,
                $category_id,
                $amoynt_product,
                '$description',
                $brand_description_id,
                $country_id,
                $resistance_id,
                '$collection_name',
                $style_id,
                $mechanism_id,
                '$model_mechaism',
                $amount_stones,
                $diametr,
                $case_color_id,
                $dial_color_id,
                '$target_file'
            )";
            
            Admin::addDataAdmin($query);
            header("Location: /admin-panel");
        } catch (Exception $e) {
            die('Ошибка: ' . $e->getMessage());
        }
    }
    public static function deleteDataProduct() {
        try {
            $id = (int)$_POST['id'];
            
            // Сначала получаем информацию о продукте, чтобы удалить изображение
            $query = "SELECT img_path FROM product WHERE id_product = $id";
            $result = Admin::getOneDataAdmin($query);
            
            if ($result && $result['img_path']) {
                $image_path = $result['img_path'];
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            
            // Удаляем продукт из базы данных
            $query = "DELETE FROM product WHERE id_product = $id";
            Admin::deleteDataAdmin($query);
            
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    public static function updateDataProduct() {
        try {
            // Получение данных из формы
            $id = (int)$_POST['id'];
            $name_product = mysqli_real_escape_string(Connect::connect(), $_POST['name_product']);
            $price = (float)$_POST['price'];
            $category_id = (int)$_POST['category_id'];
            $amoynt_product = (int)$_POST['amoynt_product'];
            $description = mysqli_real_escape_string(Connect::connect(), $_POST['description']);
            $brand_description_id = (int)$_POST['brand_description_id'];
            $country_id = (int)$_POST['country_id'];
            $resistance_id = (int)$_POST['resistance_id'];
            $collection_name = mysqli_real_escape_string(Connect::connect(), $_POST['collection_name']);
            $style_id = (int)$_POST['style_id'];
            $mechanism_id = (int)$_POST['mechanism_id'];
            $model_mechaism = mysqli_real_escape_string(Connect::connect(), $_POST['model_mechaism']);
            $amount_stones = (int)$_POST['amount_stones'];
            $diametr = (float)$_POST['diametr'];
            $case_color_id = (int)$_POST['case_color_id'];
            $dial_color_id = (int)$_POST['dial_color_id'];

            // Формирование базового SQL запроса
            $query = "UPDATE `product` SET 
                `name_product` = '$name_product',
                `price` = $price,
                `category_id` = $category_id,
                `amoynt_product` = $amoynt_product,
                `description` = '$description',
                `brand_description_id` = $brand_description_id,
                `country_id` = $country_id,
                `resistance_id` = $resistance_id,
                `collection_name` = '$collection_name',
                `style_id` = $style_id,
                `mechanism_id` = $mechanism_id,
                `model_mechaism` = '$model_mechaism',
                `amount_stones` = $amount_stones,
                `diametr` = $diametr,
                `case_color_id` = $case_color_id,
                `dial_color_id` = $dial_color_id";

            // Если загружено новое изображение
            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "public/assets/images/products/";
                $imageFileType = strtolower(pathinfo($_FILES["product_image"]["name"], PATHINFO_EXTENSION));
                $image_name = uniqid() . '.' . $imageFileType;
                $target_file = $target_dir . $image_name;

                if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                    $query .= ", `img_path` = '$target_file'";
                } else {
                    throw new Exception('Ошибка загрузки изображения');
                }
            }

            $query .= " WHERE `product`.`id_product` = $id";

            Admin::updateDataAdmin($query);
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    public static function getOneProduct() {
        try {
            $id = (int)$_POST['id'];
            $query = "SELECT p.*, 
                            c.name as category_name,
                            b.id_brand_description,
                            b.description as brand_description_text,
                            co.name as country_name,
                            w.value as water_resistance_value,
                            s.name as style_name,
                            m.name as mechanism_name,
                            cc.name as case_color_name,
                            dc.name as dial_color_name
                     FROM product p
                     LEFT JOIN category c ON p.category_id = c.id_category
                     LEFT JOIN brand_description b ON p.brand_description_id = b.id_brand_description
                     LEFT JOIN country co ON p.country_id = co.id_country
                     LEFT JOIN water_resistance w ON p.resistance_id = w.id_resistance
                     LEFT JOIN style s ON p.style_id = s.id_style
                     LEFT JOIN mechanism m ON p.mechanism_id = m.id_mechanism
                     LEFT JOIN case_color cc ON p.case_color_id = cc.id_case_color
                     LEFT JOIN dial_color dc ON p.dial_color_id = dc.id_dial_color
                     WHERE p.id_product = $id";
            
            $result = Admin::getOneDataAdmin($query);
            if (!$result) {
                throw new Exception('Продукт не найден');
            }
            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
