<?php

namespace core\controllers;

use core\models\Product;
use view\View;

class ProductController
{

    public $view;
    public $products;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../views');
        $this->products = new Product();
    }

    public function getAllProducts($namePage)
    {
        return $this->view->render("pages/$namePage.php", ['data' => $this->products->getAllProducts()]);
    }

    public function getOneProduct($namePage, $id)
    {
        return $this->view->render("pages/$namePage.php", ['data' => $this->products->getOneProduct($id)]);
    }

    public function getProductsByBrand($brand)
    {
        $products = $this->products->getProductsByBrand($brand);
        $this->view->render("pages/{$brand}.php", ['data' => $products]);
    }

}