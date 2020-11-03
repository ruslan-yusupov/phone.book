<?php
namespace App;

class Router
{
    protected array $rules;
    protected string $uri;

    public function __construct(array $rules, string $uri)
    {
        $this->rules = $rules;
        $this->uri   = $this->getUri($uri);
    }

    protected function getUri($uri)
    {
        return trim($uri, '/');
    }

    public function map($request)
    {

        //TODO mapping

    }

    public function run()
    {

        foreach ($this->rules as $rule => $controller) {
            if ($rule === $this->uri) {
                include $_SERVER['DOCUMENT_ROOT'] . $controller;
            }
        }

    }
}