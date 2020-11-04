<?php

namespace App\Controllers;

use App\Controller;

class Error404 extends Controller
{

    public function actionDefault()
    {
        header('HTTP/1.1 404 Not Found');
        echo $this->view->render(__DIR__ . '/../Templates/404.php');
    }

}