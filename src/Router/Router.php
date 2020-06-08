<?php

namespace MagicFramework\Router;

use MagicFramework\Router\Exception\ControllerDoesNotExistException;
use MagicFramework\Router\Matcher\RouteMatcher;
use MagicFramework\Router\Exception\RequestDidNotMatchException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Router
{
    /**
     * @var RouteCollection
     */
    private $routeCollection;

    /**
     * @var RouteMatcher
     */
    private $routeMatcher;

    public function __construct(
        RouteCollection $routeCollection,
        RouteMatcher $routeMatcher
    ) {
        $this->routeCollection = $routeCollection;
        $this->routeMatcher = $routeMatcher;
    }

    /**
     * @param RequestInterface $request
     *
     * @throws ControllerDoesNotExistException
     * @throws RequestDidNotMatchException
     *
     * @return ResponseInterface
     */
    public function dispatch(RequestInterface $request): ResponseInterface
    {
        foreach ($this->routeCollection->all() as $route) {
            if (false !== $resolvedParams = $this->routeMatcher->match($route, $request)) {

                list($class, $method) = explode('::', $route->getController(), 2);

                if (!method_exists($class, $method)) {
                    throw new ControllerDoesNotExistException($class, $method);
                }

                $reOrderedParams = [];
                $controller = new \ReflectionMethod($class, $method);
                foreach ($controller->getParameters() as $param) {
                    $reOrderedParams[$param->getPosition()] = $resolvedParams[$param->getName()];
                }

                return call_user_func_array([new $class(), $method], $reOrderedParams);
            }
        }

        throw new RequestDidNotMatchException($request);
    }
}
