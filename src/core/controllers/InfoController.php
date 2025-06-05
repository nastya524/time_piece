<?php

namespace core\controllers;

use src\view\View;

class InfoController
{
    public function delivery()
    {
        require_once __DIR__ . '/../../../views/pages/delivery.php';
    }

    public function payment()
    {
        require_once __DIR__ . '/../../../views/pages/payment.php';
    }

    public function warranty()
    {
        require_once __DIR__ . '/../../../views/pages/warranty.php';
    }
} 