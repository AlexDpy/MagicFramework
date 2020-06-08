<?php

namespace Test\MagicFramework\Router;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use MagicFramework\Router\Matcher\RouteMatcher;
use MagicFramework\Router\Matcher\TokenResolver;
use MagicFramework\Router\Route;
use MagicFramework\Router\RouteCollection;
use MagicFramework\Router\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /**
     * @var Router
     */
    private $SUT;

    /** @var RouteCollection */
    private $routeCollection;

    protected function setUp(): void
    {
        $this->routeCollection = new RouteCollection();

        $this->SUT = new Router($this->routeCollection, new RouteMatcher(new TokenResolver()));
    }

    /**
     * @test
     */
    public function itShouldCallTheController()
    {
        // Arrange
        $this->routeCollection->add(
            'homepage',
            new Route('Test\MagicFramework\Router\FakeController::homepage', '/')
        );
        $request = new Request('GET', '/');

        // Act
        $result = $this->SUT->dispatch($request, [FakeController::class => new FakeController()]);

        // Assert
        $this->assertEquals(new Response(), $result);
    }

    /**
     * @test
     */
    public function itShouldCallTheControllerWithTheParameters()
    {
        // Arrange
        $this->routeCollection->add(
            'blog',
            new Route('Test\MagicFramework\Router\FakeController::routeWithParams', '/blog/{year}/{month}/{day}')
        );
        $request = new Request('GET', '/blog/2020/06/08');

        // Act
        $result = $this->SUT->dispatch($request, [FakeController::class => new FakeController()])->getBody()->getContents();

        // Assert
        $this->assertEquals('day:08|month:06|year:2020', $result);
    }

    /**
     * @test
     */
    public function itShouldCallTheControllerWithTheParametersInTheRightOrder()
    {
        // Arrange
        $this->routeCollection->add(
            'blog',
            new Route('Test\MagicFramework\Router\FakeController::routeWithParamsNotInOrder', '/blog/{year}/{month}/{day}')
        );
        $request = new Request('GET', '/blog/2020/06/08');

        // Act
        $result = $this->SUT->dispatch($request, [FakeController::class => new FakeController()])->getBody()->getContents();

        // Assert
        $this->assertEquals('day:08|month:06|year:2020', $result);
    }
}

class FakeController
{
    public function homepage()
    {
        return new Response();
    }

    public function routeWithParams($year, $month, $day)
    {
        return new Response(200, [], "day:$day|month:$month|year:$year");
    }

    public function routeWithParamsNotInOrder($day, $month, $year)
    {
        return new Response(200, [], "day:$day|month:$month|year:$year");
    }
}
