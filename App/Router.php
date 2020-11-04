<?php
namespace App;

use Exception;

/**
 * @package App
 *
 * @property array $routes
 */
class Router
{

    protected array $routes;

    /**
     * Router constructor.
     */
    public function __construct()
    {

    }


    /**
     * @param string $method
     * @param string $rule
     * @param string $controllerName
     * @param string $action
     * @return $this
     */
    public function add(string $method, string $rule, string $controllerName, string $action = 'Default'): self
    {
        $this->routes[$method][] = [
            'rule'           => '~^' . str_replace('/', '\/', $rule) . '$~',
            'controllerName' => $controllerName,
            'methodName'     => $action,
            'params'         => [],

        ];

        return $this;

    }


    /**
     * @param $method
     * @param $uri
     * @return mixed|null
     * @throws Exception
     */
    public function dispatch(string $method, string $uri)
    {
        $path = parse_url($uri, PHP_URL_PATH);

        foreach ($this->routes[$method] as $route) {

            if (preg_match($route['rule'], $path, $params)) {

                if (!empty($params[1])) {
                    $route['params']['id'] = $params[1];
                }

                return $route;

            }

        }

        throw new Exception('No routes found', 404);

    }

}