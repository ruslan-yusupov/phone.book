<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Contact;
use App\Models\User;

class Contacts extends Controller
{

    protected function access(): bool
    {
        return !empty(User::getCurrentUser());
    }

    public function index()
    {
        $this->view->contacts = Contact::findAll();
        $this->view->user     = User::getCurrentUser();

        echo $this->view->render('/contacts/list.php');

    }

    public function detail()
    {

        $id = 1;

        $this->view->contacts = Contact::findById($id);
        echo $this->view->render('/contacts/list.php');

    }

    public function new()
    {

        echo $this->view->render('/contacts/add.php');

    }

    public function add()
    {

        switch (true) {
            case empty($_POST['name']):
            case empty($_POST['surname']):
            case empty($_POST['phone_number']):
            case empty($_POST['email']):
            case empty($_POST['picture']):
                echo $this->view->render('/contacts/add.php');
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

    public function update()
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

        echo $this->view->render('/contacts/update.php');

    }

    public function delete()
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