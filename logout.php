<?php

require_once __DIR__ . '/autoload.php';

use App\User;

User::logout();

header('Location: /');
die;


