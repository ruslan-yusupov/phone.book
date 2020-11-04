<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Session;
use App\Models\User;

class Authorization extends Controller
{


    public function actionDefault()
    {

        echo $this->view->render(__DIR__ . '/../Templates/user/auth.php');

    }


    public function actionAuth()
    {
        $email    = strval(htmlspecialchars($_POST['email']));
        $password = strval(htmlspecialchars($_POST['password']));

        switch (true) {
            case empty($email):
            case empty($password):
                header('Location: /auth');
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


    public function actionLogout()
    {
        User::logout();

        header('Location: /auth');
        die;
    }

}