<?php

use App\Models\Contact;

if (empty($_GET['id'])) {

    header('Location: /contacts/index.php');
    die;

}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../autoload.php';

$contactId = intval(htmlspecialchars($_GET['id']));

$contact = Contact::findById($contactId);

if (false === $contact) {
    $contact = new Contact;
}

foreach (get_object_vars($contact) as $field => $value) {
    if (!empty($_POST[$field])) {
        $contact->$field = htmlspecialchars($_POST[$field]);
    }
}

$contact->save();

include __DIR__ . '/../App/Templates/contacts/update.php';