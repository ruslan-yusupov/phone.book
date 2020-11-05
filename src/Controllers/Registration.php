<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;
use App\Validator;

class Registration extends Controller
{

    public function index()
    {
        echo $this->view->render('/user/registration.php');
    }


    public function register()
    {
        $login           = trim($_POST['login']);
        $email           = trim($_POST['email']);
        $password        = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirm_password']);
        $alerts          = [];

        //Check fields
        switch (false) {
            case Validator::checkLogin($login):
                $alerts[] = 'Логин должен состоять из латинских букв, цифр
                 и быть не больше 16-ти знаков';
            case Validator::checkEmail($email):
                $alerts[] = 'Некорректный адрес электронной почты';
            case Validator::checkPassword($password):
                $alerts[] = 'Пароль должен состоять из цифр, латинских символов разных регистров 
                и быть не меньше 6-ти знаков';
            case $password === $confirmPassword:
                $alerts[] = 'Пароли не совпадают';
            default:
                break;
        }

        //Check user fields
        if (false !== User::findByLogin($login)) {
            $alerts[] = 'Пользователь с таким логином уже существует';
        }

        if (false !== User::findByEmail($email)) {
            $alerts[] = 'Пользователь с таким Email уже существует';
        }


        if (!empty($alerts)) {
            $this->view->alerts = $alerts;
            echo $this->view->render('/user/registration.php');
            die;
        }

        //Register a user
        User::register($login, $email, $password);

        header('Location: /auth');
        die;
    }

}
