<?php

use App\Models\Contact;

if (empty($_GET['id'])) {

    header('Location: /admin/index.php');
    die;

}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../autoload.php';

$contactId = intval(htmlspecialchars($_GET['id']));

$contact = Contact::findById($contactId);
$contact->delete();

header('Location: /contacts/index.php');
die;