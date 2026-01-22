<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;

class Router 
{
    private array $routes;

    public function register(string $route, callable $action) : self
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
        return call_user_func($action);
    }
}