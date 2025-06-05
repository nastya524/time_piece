<?php

namespace core\models;

use services\Connect;
use services\Helper;

class User
{

    public function registerUser($email, $first_name, $last_name, $password, $password_confirm, $phone)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = Connect::Connect()->query("INSERT INTO `user`(`first_name`, `last_name`, `email`, `phone`, `password`) VALUES ('$first_name', '$last_name', '$email', '$phone', '$password')");
    }

    public function loginUser($email, $password)
    {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            Helper::setOldValue('email', $email);
            Helper::setValidationError('email', 'Неверный формат электронной почты');
            Helper::setMessage('error', 'Ошибка валидации');
            Helper::redirect('/log-in');
        }
        $query = Connect::Connect()->query("SELECT * FROM `user` WHERE email = '$email'");
        $user = mysqli_fetch_assoc($query);
        if(!$user){
            Helper::setMessage('error', "Пользователь $email не найден");
            Helper::redirect('/log-in');
        }

        if (!password_verify($password, $user['password']))
        {
            Helper::setMessage('error', "Неверный логин или пароль");
            Helper::redirect('/log-in');
        }

        if(password_verify($password, $user['password'])) {
            session_start();
            $_SESSION["user"] = [
              'id' => $user['id_user'],
              'first_name' => $user['first_name'],
              'last_name' => $user['last_name'],
              'email' => $user['email'],
              'password' => $user['password'],
              'role' => $user['role']
            ];
            if ($_SESSION["user"]["role"] != 0) {
                Helper::redirect('/admin-panel');
            }
        }
    }
}