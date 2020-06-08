<?php

namespace MagicFramework\Router\Matcher;

use MagicFramework\Router\Route;
use Psr\Http\Message\RequestInterface;

class RouteMatcher
{
    /**
     * @var TokenResolver
     */
    private $tokenResolver;

    public function __construct(TokenResolver $tokenResolver)
    {
        $this->tokenResolver = $tokenResolver;
    }

    /**
     * @param Route $route
     * @param RequestInterface $request
     *
     * @return string[]|bool An array of resolved parameters or false if it did not match
     */
    public function match(Route $route, RequestInterface $request)
    {
        $routeTokens = explode('/', trim($route->getPath(), '/'));
        $requestTokens = explode('/', trim($request->getUri()->getPath(), '/'));

        $params = [];

        if (empty($route->getDefaults()) && count($requestTokens) !== count($routeTokens)) {
            return false;
        }

        if ($route->getDefaults() && count($requestTokens) > count($routeTokens)) {
            return false;
        }

        foreach ($routeTokens as $index => $routeToken) {
            if (false === $token = $this->tokenResolver->resolve(
                $routeToken,
                $requestTokens[$index] ?? null,
                $route->getRequirements(),
                $route->getDefaults()
            )) {
                return false;
            }

            if (array_key_exists($token->getName(), $route->getDefaults())) {
                $requestTokens[$index] = $token->getValue();
            }

            if ($token->getValue() !== $requestTokens[$index]) {
                return false;
            }

            if ($token->isParametrized()) {
                $params[$token->getName()] = $token->getValue();
            }
        }

        return $params;
    }
}
