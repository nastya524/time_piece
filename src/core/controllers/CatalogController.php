<?php

namespace core\controllers;

use core\models\Product;
use view\View;

class CatalogController
{
    private $view;
    private $products;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../views');
        $this->products = new Product();
    }

    public function index()
    {
        require_once __DIR__ . '/../../../views/partials/header.php';
        
        $brand = isset($_GET['brand']) ? $_GET['brand'] : null;
        $products = $brand ? $this->products->getProductsByBrand($brand) : $this->products->getAllProducts();
        
        $this->view->render("pages/catalog.php", [
            'data' => $products,
            'selectedBrand' => $brand
        ]);
        
        require_once __DIR__ . '/../../../views/partials/footer.php';
    }

    public function rolex()
    {
        require_once __DIR__ . '/../../../views/partials/header.php';
        $this->view->render("pages/rolex.php", ['data' => $this->products->getProductsByBrand('ROLEX')]);
        require_once __DIR__ . '/../../../views/partials/footer.php';
    }

    public function tissot()
    {
        require_once __DIR__ . '/../../../views/partials/header.php';
        $this->view->render("pages/tissot.php", ['data' => $this->products->getProductsByBrand('TISSOT')]);
        require_once __DIR__ . '/../../../views/partials/footer.php';
    }

    public function certina()
    {
        require_once __DIR__ . '/../../../views/partials/header.php';
        $this->view->render("pages/certina.php", ['data' => $this->products->getProductsByBrand('CERTINA')]);
        require_once __DIR__ . '/../../../views/partials/footer.php';
    }

    public function frederique()
    {
        require_once __DIR__ . '/../../../views/partials/header.php';
        $this->view->render("pages/frederique.php", ['data' => $this->products->getProductsByBrand('FREDERIQUE CONSTANT')]);
        require_once __DIR__ . '/../../../views/partials/footer.php';
    }

    public function cover()
    {
        require_once __DIR__ . '/../../../views/partials/header.php';
        $this->view->render("pages/cover.php", ['data' => $this->products->getProductsByBrand('COVER')]);
        require_once __DIR__ . '/../../../views/partials/footer.php';
    }

    public function guess()
    {
        require_once __DIR__ . '/../../../views/partials/header.php';
        $this->view->render("pages/guess.php", ['data' => $this->products->getProductsByBrand('GUESS')]);
        require_once __DIR__ . '/../../../views/partials/footer.php';
    }
} 