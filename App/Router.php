<?php
namespace App;

class Router
{
    protected array $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    protected function getUri()
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }

    public function run()
    {



    }
}