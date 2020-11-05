<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Contact;
use App\Models\User;
use App\Validator;
use Exception;

class Contacts extends Controller
{

    protected $user;


    /**
     * Contacts constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->user = User::getCurrentUser();
    }


    /**
     * @return bool
     */
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

        $this->view->user    = User::getCurrentUser();
        $this->view->contact = Contact::findById($params['id']);

        if (empty($this->view->contact)) {
            throw new Exception('Contact not found', 404);
        }

        echo $this->view->render('/contacts/detail.php');
    }


    public function add()
    {
        $alerts = [];

        //Check fields
        switch (false) {
            case Validator::checkInput($_POST['name']):
                $alerts['name'] = 'Поле "Имя" не заполнено';
            case Validator::checkInput($_POST['surname']):
                $alerts['surname'] = 'Поле "Фамилия" не заполнено';
            case Validator::checkEmail($_POST['email']):
                $alerts['email'] = 'Некорректно введен Email';
            case Validator::checkInput($_POST['phone_number']):
                $alerts['phone_number'] = 'Поле "Телефон" не заполнено';
            case Validator::checkImage($_FILES['picture']):
                $alerts['picture'] = 'Изображение должно быть не больше 5МБ, jpeg или png';
        }


        if (!empty($alerts)) {

            $this->view->alerts = $alerts;

            $response = [
                'status' => 'error',
                'html'   => $this->view->render('/contacts/form.php')
            ];

            echo json_encode($response);
            die;
        }

        //Create a contact
        $contact = new Contact;

        $contact->name         = strval(htmlspecialchars($_POST['name']));
        $contact->surname      = strval(htmlspecialchars($_POST['surname']));
        $contact->phone_number = strval(htmlspecialchars($_POST['phone_number']));
        $contact->email        = strval(htmlspecialchars($_POST['email']));
        $contact->picture      = $_FILES['picture']['name'];
        $contact->user_id      = $this->user->id;

        //Check if the file is uploaded
        $isFileUploaded = move_uploaded_file(
            $_FILES['picture']['tmp_name'],
            realpath(__DIR__ . '/../../public/uploads/') . '/' . $contact->picture
        );

        if (false === $isFileUploaded) {
            $alerts[] = 'Произошла ошибка с загрузкой файла';

            $this->view->alerts = $alerts;

            $response = [
                'status' => 'error',
                'html'   => $this->view->render('/contacts/form.php')
            ];

            echo json_encode($response);
            die;
        }

        //Save a contact
        $contact->save();

        $this->view->count   = Contact::getCount();
        $this->view->contact = $contact;

        $response = [
            'status' => 'success',
            'html'   => $this->view->render('/contacts/add.php')
        ];

        echo json_encode($response);
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
