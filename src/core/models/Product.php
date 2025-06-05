<?php

namespace core\models;

use services\Connect;

class Product
{

    public function getAllProducts()
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
        ");
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;

        }
        return $data;
    }

    public function getOneProduct($id)
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
        WHERE product.id_product = '$id'
        ");
        return mysqli_fetch_assoc($query);
    }

    public static function updateProductQuantity($productId, $quantity)
    {
        // Уменьшаем количество товара в таблице products
        $sql = "UPDATE `product` SET amoynt_product = amoynt_product - $quantity WHERE id_product = $productId";
        $result = Connect::Connect()->query($sql);

        return $result ? true : false;
    }

    public function getProductsByBrand($brand)
    {
        $brandMap = [
            'rolex' => 'Rolex',
            'tissot' => 'Tissot',
            'certina' => 'Certina',
            'frederique' => 'Frederique Constant',
            'cover' => 'Cover',
            'guess' => 'GUESS'
        ];
        
        $brandName = $brandMap[$brand] ?? $brand;
        
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
        WHERE brand_description.name_brand_description LIKE '%$brandName%'
        ");
        
        if (!$query) {
            return [];
        }
        
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
        
        return $data;
    }

}