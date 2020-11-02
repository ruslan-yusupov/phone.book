<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../autoload.php';

use App\Models\Contact;
use App\View;

$view = new View();
$view->contacts = Contact::findAll();

$content = $view->render(__DIR__ . '/../App/Templates/contacts/list.php');
echo $content;
