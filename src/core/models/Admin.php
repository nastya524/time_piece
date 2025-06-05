<?php

namespace core\models;

use services\Connect;
use Exception;

class Admin
{
    public static function getAllProductsMale()
    {
        $query = Connect::Connect()->query("
        SELECT product.*, brand_description.name_brand_description, country.name_country, style.name_style, mechanism.name_mechanism, case_color.name_case_color, dial_color.name_dial_color, category.name_category, resistance.name_resistance
        FROM product
        JOIN brand_description ON product.brand_description_id = brand_description.id_brand_description
        JOIN country ON product.country_id = country.id_country
        JOIN style ON product.style_id = style.id_style
        JOIN mechanism ON product.mechanism_id = mechanism.id_mechanism
        JOIN case_color ON product.case_color_id = case_color.id_case_color
        JOIN dial_color ON product.dial_color_id = dial_color.id_dial_color
        JOIN category ON product.category_id = category.id_category
        JOIN resistance ON product.resistance_id = resistance.id_resistance
        WHERE `product`.`category_id` = '1'
        ");
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;

        }
        return $data;
    }
    public static function getAllProductsFemale()
    {
        $query = Connect::Connect()->query("
        SELECT product.*, brand_description.name_brand_description, country.name_country, style.name_style, mechanism.name_mechanism, case_color.name_case_color, dial_color.name_dial_color, category.name_category, resistance.name_resistance
        FROM product
        JOIN brand_description ON product.brand_description_id = brand_description.id_brand_description
        JOIN country ON product.country_id = country.id_country
        JOIN style ON product.style_id = style.id_style
        JOIN mechanism ON product.mechanism_id = mechanism.id_mechanism
        JOIN case_color ON product.case_color_id = case_color.id_case_color
        JOIN dial_color ON product.dial_color_id = dial_color.id_dial_color
        JOIN category ON product.category_id = category.id_category
        JOIN resistance ON product.resistance_id = resistance.id_resistance
        WHERE `product`.`category_id` = '2'
        ");
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;

        }
        return $data;
    }

    public static function getOneProductMale()
    {
        $query = Connect::Connect()->query("
        SELECT product.*, brand_description.name_brand_description, country.name_country, style.name_style, mechanism.name_mechanism, case_color.name_case_color, dial_color.name_dial_color, category.name_category, resistance.name_resistance
        FROM product
        JOIN brand_description ON product.brand_description_id = brand_description.id_brand_description
        JOIN country ON product.country_id = country.id_country
        JOIN style ON product.style_id = style.id_style
        JOIN mechanism ON product.mechanism_id = mechanism.id_mechanism
        JOIN case_color ON product.case_color_id = case_color.id_case_color
        JOIN dial_color ON product.dial_color_id = dial_color.id_dial_color
        JOIN category ON product.category_id = category.id_category
        JOIN resistance ON product.resistance_id = resistance.id_resistance
        WHERE `product`.`category_id` = '1'
        ");
        return mysqli_fetch_assoc($query);
    }
    public static function getOneProductFemale()
    {
        $query = Connect::Connect()->query("
        SELECT product.*, brand_description.name_brand_description, country.name_country, style.name_style, mechanism.name_mechanism, case_color.name_case_color, dial_color.name_dial_color, category.name_category, resistance.name_resistance
        FROM product
        JOIN brand_description ON product.brand_description_id = brand_description.id_brand_description
        JOIN country ON product.country_id = country.id_country
        JOIN style ON product.style_id = style.id_style
        JOIN mechanism ON product.mechanism_id = mechanism.id_mechanism
        JOIN case_color ON product.case_color_id = case_color.id_case_color
        JOIN dial_color ON product.dial_color_id = dial_color.id_dial_color
        JOIN category ON product.category_id = category.id_category
        JOIN resistance ON product.resistance_id = resistance.id_resistance
        WHERE `product`.`category_id` = '2'
        ");
        return mysqli_fetch_assoc($query);
    }
    public static function getOneProduct()
    {
        $id = $_POST['id'];
        $query = Connect::Connect()->query("
        SELECT product.*, brand_description.name_brand_description, country.name_country, style.name_style, mechanism.name_mechanism, case_color.name_case_color, dial_color.name_dial_color, category.name_category, resistance.name_resistance
        FROM product
        JOIN brand_description ON product.brand_description_id = brand_description.id_brand_description
        JOIN country ON product.country_id = country.id_country
        JOIN style ON product.style_id = style.id_style
        JOIN mechanism ON product.mechanism_id = mechanism.id_mechanism
        JOIN case_color ON product.case_color_id = case_color.id_case_color
        JOIN dial_color ON product.dial_color_id = dial_color.id_dial_color
        JOIN category ON product.category_id = category.id_category
        JOIN resistance ON product.resistance_id = resistance.id_resistance
        WHERE product.id_product = '$id'
        ");

        $product = mysqli_fetch_assoc($query);
        $json_data = json_encode($product, JSON_UNESCAPED_UNICODE);
        echo $json_data;
    }
    public static function updateDataAdmin($updateQuery)
    {
        $connection = Connect::connect();
        $query = mysqli_query($connection, $updateQuery);
        if (!$query) {
            $error = mysqli_error($connection);
            $errno = mysqli_errno($connection);
            throw new Exception("Ошибка обновления (код $errno): $error\nЗапрос: $updateQuery");
        }
        return true;
    }
    public static function deleteDataAdmin($deleteQuery)
    {
        $query = mysqli_query(Connect::connect(), $deleteQuery);
        if (!$query) {
            throw new Exception('Ошибка удаления: ' . mysqli_error(Connect::connect()));
        }
        return true;
    }
    public static function addDataAdmin($insertQuery)
    {
        $connection = Connect::connect();
        $query = mysqli_query($connection, $insertQuery);
        if (!$query) {
            $error = mysqli_error($connection);
            $errno = mysqli_errno($connection);
            die("Ошибка добавления (код $errno): $error\nЗапрос: $insertQuery");
        }
    }
    public static function getOneDataAdmin($query)
    {
        $result = mysqli_query(Connect::connect(), $query);
        if (!$result) {
            throw new Exception('Ошибка получения данных: ' . mysqli_error(Connect::connect()));
        }
        $data = mysqli_fetch_assoc($result);
        if (!$data) {
            throw new Exception('Данные не найдены');
        }
        return $data;
    }
    public static function getAllBrandDescriptions()
    {
        $query = Connect::Connect()->query("
            SELECT id_brand_description, name_brand_description 
            FROM brand_description 
            ORDER BY name_brand_description
        ");
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
        return $data;
    }
}