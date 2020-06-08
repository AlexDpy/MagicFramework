<?php

namespace MagicFramework;

use GuzzleHttp\Psr7\Response;
use MagicFramework\Router\Configuration\YamlConfigurationLoader;
use MagicFramework\Router\Exception\RouterException;
use MagicFramework\Router\Matcher\RouteMatcher;
use MagicFramework\Router\Matcher\TokenResolver;
use MagicFramework\Router\Router;
use Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface;

class Kernel
{
    /**
     * @var Router
     */
    private $router;

    public function __construct()
    {
        $routeCollection = (new YamlConfigurationLoader())->load(__DIR__ . '/../config/routing.yaml');
        $routeMatcher = new RouteMatcher(new TokenResolver());
        $this->router = new Router($routeCollection, $routeMatcher);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            return $this->router->dispatch($request);
        } catch (RouterException $e) {
            return new Response(404, [], $e->getMessage());
        } catch (\Throwable $e) {
            return new Response(500, [], $e->getMessage());
        }
    }
}
