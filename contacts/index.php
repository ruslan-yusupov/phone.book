<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../autoload.php';

use App\Models\Contact;

$contacts = Contact::findAll();

dump($contacts);
