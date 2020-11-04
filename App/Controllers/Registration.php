<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Contact;
use App\Models\User;
use App\View;

class Registration extends Controller
{

    public function actionDefault()
    {

        echo $this->view->render(__DIR__ . '/../Templates/user/registration.php');

    }

    public function actionRegister()
    {

        $login           = trim($_POST['login']);
        $email           = trim($_POST['email']);
        $password        = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirm_password']);

        switch (true) {
            case empty($login):
            case empty($email):
            case empty($password):
            case empty($confirmPassword):
                header('Location: /registration');
                die;
        }

        User::register($login, $email, $password);

        header('Location: /auth');
        die;

    }

}