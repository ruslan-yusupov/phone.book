<?php

namespace App\Controllers;

use App\Controller;

class Index extends Controller
{

    public function index()
    {
        header('Location: /list');
        die;
    }

}