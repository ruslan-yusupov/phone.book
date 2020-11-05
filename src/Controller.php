<?php

namespace App;

/**
 * @package App
 *
 * @property View $view
 */
abstract class Controller
{

    protected View $view;


    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->view = new View;
    }


    /**
     * @return bool
     */
    protected function access(): bool
    {
        return true;
    }


    /**
     * @param string $name
     * @param array $params
     */
    public function action(string $name, array $params): void
    {
        if ($this->access()) {
            $this->$name($params);
        } else {
            header('Location: /auth');
            die;
        }
    }

}
