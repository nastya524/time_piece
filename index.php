<?php
    session_start();
    date_default_timezone_set('Asia/Krasnoyarsk');

    require __DIR__ . "/src/services/Connect.php";
    require __DIR__ . "/src/services/Helper.php";
    require __DIR__ . "/src/core/controllers/UserController.php";
    require __DIR__ . "/src/core/controllers/AdminController.php";
    require __DIR__ . "/src/core/controllers/ProductController.php";
    require __DIR__ . "/src/core/controllers/CatalogController.php";
    require __DIR__ . "/src/core/controllers/OrderController.php";
    require __DIR__ . "/src/core/controllers/InfoController.php";
    require __DIR__ . "/src/core/models/User.php";
    require __DIR__ . "/src/view/View.php";
    require __DIR__ . "/src/core/models/Admin.php";
    require __DIR__ . "/src/core/models/Product.php";
    require __DIR__ . "/src/core/models/Order.php";
    require __DIR__ . "/src/router/Router.php";
//    print_r($_SESSION['user']);
//    print_r($_SESSION['validation']);
    require __DIR__ . "/src/routers.php";


