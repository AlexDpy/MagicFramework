<?php

namespace Test\MagicFramework\Router\Matcher;

use GuzzleHttp\Psr7\Request;
use MagicFramework\Router\Matcher\RouteMatcher;
use MagicFramework\Router\Matcher\TokenResolver;
use MagicFramework\Router\Route;
use PHPUnit\Framework\TestCase;

class RouteMatcherTest extends TestCase
{
    /**
     * @var RouteMatcher
     */
    private $SUT;

    protected function setUp(): void
    {
        $this->SUT = new RouteMatcher(new TokenResolver());
    }

    /**
     * @test
     */
    public function itShouldMatchAPathWithoutParameters()
    {
        // Arrange
        $route = new Route('class::method', '/', []);
        $request = new Request('GET', '/');

        // Act
        $result = $this->SUT->match($route, $request);

        // Assert
        $this->assertEquals([], $result);
    }

    /**
     * @test
     */
    public function itShouldMatchALongPathWithoutParameters()
    {
        // Arrange
        $route = new Route('class::method', '/foo/bar/whatever', []);
        $request = new Request('GET', '/foo/bar/whatever');

        // Act
        $result = $this->SUT->match($route, $request);

        // Assert
        $this->assertEquals([], $result);
    }

    /**
     * @test
     */
    public function itShouldMatchAPathWithParameters()
    {
        // Arrange
        $route = new Route('class::method', '/blog/{year}/{month}/{day}', []);
        $request = new Request('GET', '/blog/2020/06/08');

        // Act
        $result = $this->SUT->match($route, $request);

        // Assert
        $this->assertEquals([
            'year' => '2020',
            'month' => '06',
            'day' => '08',
        ], $result);
    }

    /**
     * @test
     */
    public function itShouldNotMatchIfTheNumberOfTokensInTheRouteIsGreaterThanInTheRequest()
    {
        // Arrange
        $route = new Route('class::method', '/blog/{year}/{month}/{day}/another-parameter', []);
        $request = new Request('GET', '/blog/2020/06/08');

        // Act
        $result = $this->SUT->match($route, $request);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function itShouldNotMatchIfTheNumberOfTokensInTheRouteIsLowerThanInTheRequest()
    {
        // Arrange
        $route = new Route('class::method', '/blog/{year}/{month}', []);
        $request = new Request('GET', '/blog/2020/06/08');

        // Act
        $result = $this->SUT->match($route, $request);

        // Assert
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function itShouldMatchAPathWithParametersAndRequirements()
    {
        // Arrange
        $route = new Route('class::method', '/blog/{year}/{month}/{day}', [
            'year' => '\d+',
            'month' => '\d+',
            'day' => '\d+',
        ]);
        $request = new Request('GET', '/blog/2020/06/08');

        // Act
        $result = $this->SUT->match($route, $request);

        // Assert
        $this->assertEquals([
            'year' => '2020',
            'month' => '06',
            'day' => '08',
        ], $result);
    }

    /**
     * @test
     */
    public function itShouldNotMatchIfOneOfTheParametersDoesNotMatchTheRequirement()
    {
        // Arrange
        $route = new Route('class::method', '/blog/{year}/{month}/{day}', [
            'year' => '\d+',
            'month' => '\d+',
            'day' => '\d+',
        ]);
        $request = new Request('GET', '/blog/2020/six/08');

        // Act
        $result = $this->SUT->match($route, $request);

        // Assert
        $this->assertFalse($result);
    }
}
