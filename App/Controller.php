<?php

namespace App;

abstract class Controller
{

    protected View $view;

    public function __construct()
    {

        $this->view = new View;

    }

    protected function beforeAction()
    {

    }

    protected function access(): bool
    {
        return true;
    }

    public function action(string $name)
    {
        $this->beforeAction();
        $action = 'action' . $name;

        if ($this->access()) {
            $this->$action();
        } else {
            header('Location: /auth');
            die;
        }

    }



}