<?php

namespace App\Controllers;

use App\Controller;

class Error404 extends Controller
{

    public function index()
    {
        header('HTTP/1.1 404 Not Found');
        echo $this->view->render('/404.php');
    }

}