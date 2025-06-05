<?php

use router\Router;

Router::myGet('/','home');
Router::myGet('/about.php', 'about');
Router::myGet('/log-in', 'log-in');
Router::myGet('/registration', 'registration');
Router::myGet('/catalog', 'catalog');
Router::myGet('/product-single.php', 'product-single');
Router::myGet('/catalog-man', 'catalog-man');
Router::myGet('/catalog-woman', 'catalog-woman');
Router::myGet('/cart', 'cart');
Router::myGet('/brands', 'brands');
Router::myGet('/error-404', 'error-404');
Router::myGet('/admin-panel', 'admin');
Router::myGet('/delivery.php', 'delivery');
Router::myGet('/payment.php', 'payment');
Router::myGet('/warranty.php', 'warranty');

// Маршруты для страниц брендов
Router::myGet('/rolex', 'rolex');
Router::myGet('/tissot', 'tissot');
Router::myGet('/certina', 'certina');
Router::myGet('/frederique', 'frederique');
Router::myGet('/cover', 'cover');
Router::myGet('/guess', 'guess');

Router::myPost('/auth/registration', \core\controllers\UserController::class, 'registration');
Router::myPost('/auth/login', \core\controllers\UserController::class, 'login');
Router::myPost('/auth/logout', \core\controllers\UserController::class, 'logout');
Router::myPost('/admin-panel/add-product', \core\controllers\AdminController::class, 'addDataProduct');
Router::myPost('/deleteDataProduct', \core\controllers\AdminController::class, 'deleteDataProduct');
Router::myPost('/admin-panel/update-product', \core\controllers\AdminController::class, 'updateDataProduct');
Router::myPost('/getOneProduct', \core\models\Admin::class, 'getOneProduct');
Router::myPost('/cart/checkout', \core\controllers\CartController::class, 'checkout');
Router::myGet('/order-success', 'order-success');
Router::getContent();

