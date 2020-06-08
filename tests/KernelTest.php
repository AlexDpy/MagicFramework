<?php

namespace Test\MagicFramework;

use GuzzleHttp\Psr7\ServerRequest;
use MagicFramework\Kernel;
use PHPUnit\Framework\TestCase;

class KernelTest extends TestCase
{
    /**
     * @var Kernel
     */
    private $SUT;

    protected function setUp(): void
    {
        $this->SUT = new Kernel();
    }

    public function testHomepage()
    {
        // Arrange
        $request =  new ServerRequest('GET', '/');

        // Act
        $response = $this->SUT->handle($request);

        // Assert
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString(
            '<h1>Hello :-) This is a magic blog</h1>',
            $response->getBody()->getContents()
        );
    }

    /**
     * @test
     */
    public function testBlog()
    {
        // Arrange
        $request =  new ServerRequest('GET', '/blog/2017/03/19');

        // Act
        $response = $this->SUT->handle($request);

        // Assert
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString(
            'Route: /blog/2017/03/19',
            $response->getBody()->getContents()
        );
    }

    /**
     * @test
     */
    public function test404()
    {
        // Arrange
        $request =  new ServerRequest('GET', '/this-route/does-not/exist');

        // Act
        $response = $this->SUT->handle($request);

        // Assert
        $this->assertEquals(404, $response->getStatusCode());
    }
}
