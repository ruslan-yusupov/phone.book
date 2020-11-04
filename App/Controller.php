<?php

namespace App;

abstract class Controller
{

    protected View $view;

    public function __construct()
    {

        $this->view = new View;

    }

    protected function access(): bool
    {
        return true;
    }

    public function action(string $name)
    {
        $action = 'action' . $name;

        if ($this->access()) {
            $this->$action();
        } else {
            header('Location: /auth');
            die;
        }

    }



}