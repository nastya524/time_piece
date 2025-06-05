<?php

namespace core\controllers;

use core\models\User;
use services\Helper;

class UserController
{

    public function registration()
    {
        $email = $_POST['email'];
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirmation'];
        $phone = $_POST['phone'];
        $User = new User();
        $User -> registerUser($email, $first_name, $last_name, $password, $password_confirm, $phone);
        Helper::redirect('/log-in');
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $User = new User();
        $User -> loginUser($email, $password);
        Helper::redirect('/');
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user']);
        Helper::redirect('/');
    }

}