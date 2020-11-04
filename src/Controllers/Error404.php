<?php

namespace App\Controllers;

use App\Controller;

class Error404 extends Controller
{

    public function index($message)
    {
        header('HTTP/1.1 404 Not Found');
        $this->view->message = $message;
        echo $this->view->render('/404.php');
    }

}