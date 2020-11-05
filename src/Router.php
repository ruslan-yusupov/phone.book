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
     * @param string $method
     * @param string $rule
     * @param array $controller
     * @return $this
     */
    public function add(string $method, string $rule, array $controller): self
    {
        $this->routes[$method][] = [
            'rule'           => '~^' . str_replace('/', '\/', $rule) . '$~',
            'controllerName' => $controller[0],
            'methodName'     => $controller[1],
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
    public function dispatch(string $method, string $uri): array
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

        throw new Exception('Page not found', 404);

    }

}