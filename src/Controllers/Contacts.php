<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Contact;
use App\Models\User;
use App\Models\Validator;
use Exception;

class Contacts extends Controller
{

    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = User::getCurrentUser();

    }

    protected function access(): bool
    {
        return !empty($this->user);
    }

    public function index()
    {
        $this->view->user     = $this->user;
        $this->view->contacts = Contact::findAll();

        echo $this->view->render('/contacts/list.php');

    }

    /**
     * @param array $params
     * @throws Exception
     */
    public function detail(array $params)
    {

        if (empty($params['id'])) {
            throw new Exception('ID is missed', 404);
        }

        $this->view->user     = User::getCurrentUser();
        $this->view->contact = Contact::findById($params['id']);

        if (empty($this->view->contact)) {
            throw new Exception('Contact not found', 404);
        }

        echo $this->view->render('/contacts/detail.php');

    }

    public function new()
    {

        $this->view->user = $this->user;
        echo $this->view->render('/contacts/add.php');

    }

    public function add()
    {

        switch (true) {
            case empty($_POST['name']):
            case empty($_POST['surname']):
            case empty($_POST['phone_number']):
            case empty($_POST['email']):
            case empty($_FILES['picture']) && Validator::checkImage($_FILES['picture']):
                echo $this->view->render('/contacts/add.php');
                die;
        }

        $contact = new Contact;

        $contact->name         = strval(htmlspecialchars($_POST['name']));
        $contact->surname      = strval(htmlspecialchars($_POST['surname']));
        $contact->phone_number = strval(htmlspecialchars($_POST['phone_number']));
        $contact->email        = strval(htmlspecialchars($_POST['email']));
        $contact->picture      = $_FILES['picture']['name'];
        $contact->user_id      = $this->user->id;

        move_uploaded_file(
            $_FILES['picture']['tmp_name'],
            realpath(__DIR__ . '/../../public/uploads/') . '/' . $contact->picture
        );

        $contact->save();

        header('Location: /list');
        die;

    }

    /**
     * @param array $params
     * @throws Exception
     */
    public function delete(array $params)
    {

        if (empty($params['id'])) {
            throw new Exception('ID is missed', 404);
        }

        /**
         * @var Contact $contact
         */
        $contact = Contact::findById($params['id']);

        $contactImageFileSrc = realpath(__DIR__ . '/../../public/uploads/') . '/' . $contact->picture;

        if (true === file_exists($contactImageFileSrc)) {
            unlink($contactImageFileSrc);
        }

        if (empty($contact)) {
            throw new Exception('Contact not found', 404);
        }

        $contact->delete();

        header('Location: /list');
        die;

    }

}