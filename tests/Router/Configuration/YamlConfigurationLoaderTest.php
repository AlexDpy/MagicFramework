<?php

namespace Test\MagicFramework\Router\Configuration;

use MagicFramework\Router\Configuration\YamlConfigurationLoader;
use MagicFramework\Router\Route;
use MagicFramework\Router\RouteCollection;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Parser;

class YamlConfigurationLoaderTest extends TestCase
{
    /**
     * @var YamlConfigurationLoader
     */
    private $SUT;

    protected function setUp(): void
    {
        $this->SUT = new YamlConfigurationLoader(new Parser());
    }

    /**
     * @test
     */
    public function itShouldReadTheYamlConfigurationFile()
    {
        // Arrange
        $expectedRouteCollection = new RouteCollection();
        $expectedRouteCollection->add('route_foo_bar', new Route(
            'Foo::bar',
            '/foo/bar/{param1}/{param2}',
            [
                'param1' => '\w+',
                'param2' => '\d+',
            ],
            [
                'param2' => 1,
            ]
        ));

        // Act
        $result = $this->SUT->load(__DIR__ . '/fake_routing.yaml');

        // Assert
        $this->assertEquals($expectedRouteCollection, $result);
    }
}
