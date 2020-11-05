<?php

namespace App\Controllers;

use App\Controller;

class Error extends Controller
{

    /**
     * @param $message
     * @param string $status
     */
    public function index($message, $status = '404 Not Found')
    {
        header('HTTP/1.1 ' . $status);
        $this->view->message = $message;
        echo $this->view->render('/error.php');
    }

}