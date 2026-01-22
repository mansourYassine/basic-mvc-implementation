<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;

class Router 
{
    private array $routes;

    public function register(string $route, callable | array $action) : self
    {
        $this->routes[$route] = $action;
        return $this;
    }

    public function resolve(string $requestUri)
    {
        $pathUri = parse_url($requestUri)["path"];
        $action = $this->routes[$pathUri] ?? null;

        if ($action == null) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_array($action)) {
            [$class, $method] = $action;
            if (class_exists($class)) {
                $classObject = new $class();
                if (method_exists($classObject, $method)) {
                    return call_user_func_array([$classObject, $method], []);
                }
            }
        }

        throw new RouteNotFoundException();
    }
}