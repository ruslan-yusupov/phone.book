<?php

require_once __DIR__ . '/functions.php';

$email    = $_POST['email'];
$password = $_POST['password'];

switch (true) {
    case empty($email):
    case empty($password):
        header('Location: /');
        die;
}

$userId = authenticate($email, $password);

if (false === $userId) {
    header('Location: /');
    die;
}

$userSessionId = hash('gost-crypto', microtime(true) . uniqid());

setcookie(COOKIE_SESS_NAME, $userSessionId);
setUserSession($userId, $userSessionId);

header('Location: /');
die;


