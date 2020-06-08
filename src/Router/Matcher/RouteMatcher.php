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

    public function match(Route $route, RequestInterface $request)
    {
        $routeTokens = explode('/', $route->getPath());
        $requestTokens = explode('/', $request->getUri()->getPath());

        $params = [];

        if (count($routeTokens) !== count($requestTokens)) {
            return false;
        }

        foreach ($routeTokens as $index => $routeToken) {
            if (false === $token = $this->tokenResolver->resolve($routeToken, $requestTokens[$index], $route->getRequirements())) {
                return false;
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
