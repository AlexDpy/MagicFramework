<?php

namespace MagicFramework;

use GuzzleHttp\Psr7\Response;
use MagicFramework\Controller\BlogController;
use MagicFramework\Controller\HomeController;
use MagicFramework\Router\Configuration\YamlConfigurationLoader;
use MagicFramework\Router\Exception\RouterException;
use MagicFramework\Router\Matcher\RouteMatcher;
use MagicFramework\Router\Matcher\TokenResolver;
use MagicFramework\Router\Router;
use MagicFramework\Template\Renderer;
use Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Yaml\Parser;

class Kernel
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var
     */
    private $controllers;

    public function __construct()
    {
        $routeCollection = (new YamlConfigurationLoader(new Parser()))
            ->load(__DIR__ . '/../config/routing.yaml');
        $routeMatcher = new RouteMatcher(new TokenResolver());
        $this->router = new Router($routeCollection, $routeMatcher);
        $render = new Renderer(__DIR__ . '/Template/views/');

        $this->controllers = [
            HomeController::class => new HomeController($render),
            BlogController::class => new BlogController($render),
        ];
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            return $this->router->dispatch($request, $this->controllers);
        } catch (RouterException $e) {
            return new Response(404, [], $e->getMessage());
        } catch (\Throwable $e) {
            return new Response(500, [], $e->getMessage());
        }
    }
}
