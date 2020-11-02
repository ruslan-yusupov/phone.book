<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../autoload.php';

use App\Models\Contact;

switch (true) {
    case empty($_POST['name']):
    case empty($_POST['surname']):
    case empty($_POST['phone_number']):
    case empty($_POST['email']):
    case empty($_POST['picture']):
        include __DIR__ . '/../App/Templates/contacts/add.php';
        die;
}

$contact = new Contact;

$contact->name         = strval(htmlspecialchars($_POST['name']));
$contact->surname      = strval(htmlspecialchars($_POST['surname']));
$contact->phone_number = strval(htmlspecialchars($_POST['phone_number']));
$contact->email        = strval(htmlspecialchars($_POST['email']));
$contact->picture      = $_POST['picture'];

$contact->save();

header('Location: /contacts/index.php');
die;