<?php

require_once __DIR__ . '/autoload.php';

use App\User;

$email    = $_POST['email'];
$password = $_POST['password'];

switch (true) {
    case empty($email):
    case empty($password):
        header('Location: /');
        die;
}

$userId = User::authenticate($email, $password);

if (false === $userId) {
    header('Location: /');
    die;
}

$userSessionId = hash('gost-crypto', microtime(true) . uniqid());

setcookie(User::COOKIE_SESS_NAME, $userSessionId);
User::setSession($userId, $userSessionId);

header('Location: /');
die;


