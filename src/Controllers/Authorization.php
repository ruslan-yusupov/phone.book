<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Session;
use App\Models\User;
use App\Validator;

class Authorization extends Controller
{

    public function index()
    {
        echo $this->view->render('/user/auth.php');
    }


    public function auth()
    {
        $email    = strval(htmlspecialchars($_POST['email']));
        $password = strval(htmlspecialchars($_POST['password']));
        $alerts   = [];

        switch (false) {
            case Validator::checkEmail($email):
            case Validator::checkPassword($password):
                $alerts[] = 'Email и пароль введены неверно';
                $this->view->alerts = $alerts;
                break;
        }

        if (!empty($alerts)) {
            $this->view->alerts = $alerts;
            echo $this->view->render('/user/auth.php');
            die;
        }

        $userId = User::authenticate($email, $password);

        if (false === $userId) {
            header('Location: /auth');
            die;
        }

        $userSessionId = hash('gost-crypto', microtime(true) . uniqid());

        setcookie(User::COOKIE_SESS_NAME, $userSessionId);

        Session::deleteAllByUserId($userId);
        Session::add($userId, $userSessionId);

        header('Location: /list');
        die;
    }


    public function logout()
    {
        User::logout();

        header('Location: /auth');
        die;
    }

}
