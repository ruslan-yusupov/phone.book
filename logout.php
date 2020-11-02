<?php

require_once __DIR__ . '/autoload.php';

use App\Models\User;

User::logout();

header('Location: /');
die;


