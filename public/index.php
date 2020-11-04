<?php

use App\Controllers\Authorization;
use App\Controllers\Contacts;
use App\Controllers\Error404;
use App\Controllers\Index;
use App\Controllers\Registration;
use App\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../autoload.php';


$router = new Router;

$router
    /* Contacts */
    ->add('GET', '/', [Index::class, 'index'])
    ->add('GET', '/list', [Contacts::class, 'index'])
    ->add('GET', '/list/(\d{1,10})', [Contacts::class, 'detail'])
    ->add('POST', '/list/(\d{1,10})/delete', [Contacts::class, 'delete'])
    ->add('POST', '/list/(\d{1,10})/edit', [Contacts::class, 'edit'])
    ->add('GET', '/list/add', [Contacts::class, 'new'])
    ->add('POST', '/list/add', [Contacts::class, 'add'])

    /* Registration */
    ->add('GET', '/registration', [Registration::class, 'index'])
    ->add('POST', '/registration', [Registration::class, 'register'])

    /* Authorization */
    ->add('GET', '/auth', [Authorization::class, 'index'])
    ->add('POST', '/auth', [Authorization::class, 'auth'])
    ->add('GET', '/logout', [Authorization::class, 'logout']);


try {

    $route = $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

    //TODO is_callable
    /**
     * @var App\Controller $controller
     */
    $controller = new $route['controllerName'];
    $controller->action($route['methodName'], $route['params']);

} catch (Exception $exception) {

    switch ($exception->getCode()) {
        case 404:
            $error404 = new Error404;
            $error404->index($exception->getMessage());
            break;
    }

}
