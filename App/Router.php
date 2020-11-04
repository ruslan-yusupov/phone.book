<?php
namespace App;

use Exception;

/**
 * @package App
 *
 * @property string $method
 * @property string $path
 * @property array $params
 * @property array $routes
 */
class Router
{
    protected string $method;
    protected array $path;
    protected array $params;
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
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function add(string $method, string $rule, string $controller, string $action = 'Default'): self
    {
        $this->routes[$method][] = [
            'rule'    => '~^' . str_replace('/', '\/', $rule) . '$~',
            'controller' => $controller,
            'method'  => 'action' . $action,
            'params' => [],

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