<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/autoload.php';


$router = new \App\Router;

$router
    ->add('GET', '/list', '\App\Controllers\Contacts', 'List')
    ->add('GET', '/list/(\d{1,10})', '\App\Controllers\Contacts', 'Detail')
    ->add('POST', '/list/(\d{1,10})/delete', '\App\Controllers\Contacts', 'Delete')
    ->add('POST', '/list/(\d{1,10})/edit', '\App\Controllers\Contacts', 'Edit')
    ->add('POST', '/list/add', '\App\Controllers\Contacts', 'Add')

    ->add('GET', '/registration', '\App\Controllers\Registration')
    ->add('POST', '/registration', '\App\Controllers\Registration', 'Register')

    ->add('GET', '/auth', '\App\Controllers\Authorization')
    ->add('POST', '/auth', '\App\Controllers\Authorization', 'Auth')
    ->add('POST', '/logout', '\App\Controllers\Authorization', 'Logout');


try {

    $route = $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

    $controllerClass = $route['controller'];
    $action = $route['method'];

    $controller = new $controllerClass;
    $controller->$action();

} catch (Exception $exception) {

    switch ($exception->getCode()) {
        case 404:
            new \App\Controllers\Error404;
            break;
    }

}
