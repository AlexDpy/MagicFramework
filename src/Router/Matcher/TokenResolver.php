<?php

namespace MagicFramework\Router\Matcher;

class TokenResolver
{
    /**
     * @param string $routeToken
     * @param string $requestToken
     * @param string[] $requirements
     * @param string|null $default
     *
     * @return bool|string
     */
    public function resolve(string $routeToken, string $requestToken, array $requirements = [], string $default = null)
    {
        if (preg_match('/\{(\w+)\}/', $routeToken, $matches) > 0) {
            $tokenName = $matches[1];

            if (array_key_exists($tokenName, $requirements)
                && preg_match('/' . $requirements[$matches[1]] . '/', $requestToken) === 0
            ) {
                return false;
            }

            return new Token($requestToken, $tokenName);
        }

        if ($routeToken === $requestToken) {
            return new Token($requestToken);
        }

        return false;
    }
}
