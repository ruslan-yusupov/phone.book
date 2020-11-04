<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Contact;
use App\Models\User;

class Contacts extends Controller
{

    protected function beforeAction()
    {
        //TODO action before action
    }

    protected function access(): bool
    {
        return !empty(User::getCurrentUser());
    }

    public function actionDefault()
    {
        $this->view->contacts = Contact::findAll();
        $this->view->user     = User::getCurrentUser();

        echo $this->view->render(__DIR__ . '/../Templates/contacts/list.php');

    }

    public function actionDetail()
    {

        $id = 1;

        $this->view->contacts = Contact::findById($id);
        echo $this->view->render(__DIR__ . '/../Templates/contacts/list.php');

    }

    public function actionNew()
    {

        echo $this->view->render(__DIR__ . '/../Templates/contacts/add.php');

    }

    public function actionAdd()
    {

        switch (true) {
            case empty($_POST['name']):
            case empty($_POST['surname']):
            case empty($_POST['phone_number']):
            case empty($_POST['email']):
            case empty($_POST['picture']):
                include __DIR__ . '/../Templates/contacts/add.php';
                die;
        }

        $contact = new Contact;

        $contact->name         = strval(htmlspecialchars($_POST['name']));
        $contact->surname      = strval(htmlspecialchars($_POST['surname']));
        $contact->phone_number = strval(htmlspecialchars($_POST['phone_number']));
        $contact->email        = strval(htmlspecialchars($_POST['email']));
        $contact->picture      = $_POST['picture'];

        $contact->save();

        header('Location: /list');
        die;

    }

    public function actionUpdate()
    {

        if (empty($_GET['id'])) {

            header('Location: /list');
            die;

        }

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

        include __DIR__ . '/../Templates/contacts/update.php';

    }

    public function actionDelete()
    {

        if (empty($_GET['id'])) {

            header('Location: /list');
            die;

        }

        $contactId = intval(htmlspecialchars($_GET['id']));

        $contact = Contact::findById($contactId);
        $contact->delete();

    }

}