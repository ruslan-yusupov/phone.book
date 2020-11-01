<?php

require_once __DIR__ . '/functions.php';

$login    = $_POST['login'];
$email    = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

switch (true) {
    case empty($login):
    case empty($email):
    case empty($password):
        header('Location: /registration');
        die;
}

register($login, $email, $password);

header('Location: /');
die;


