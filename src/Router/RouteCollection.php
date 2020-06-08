<?php

namespace MagicFramework\Router;

class RouteCollection
{
    /**
     * @var Route[]
     */
    private $routes = [];

    public function add(string $name, Route $route)
    {
        $this->routes[$name] = $route;
    }

    /**
     * @return Route[]
     */
    public function all(): array
    {
        return $this->routes;
    }
}
