<?php

namespace Test\MagicFramework\Router\Matcher;

use MagicFramework\Router\Matcher\Token;
use MagicFramework\Router\Matcher\TokenResolver;
use PHPUnit\Framework\TestCase;

class TokenResolverTest extends TestCase
{
    /**
     * @var TokenResolver
     */
    private $SUT;

    protected function setUp(): void
    {
        $this->SUT = new TokenResolver();
    }

    /**
     * @test
     */
    public function itShouldResolveASimpleToken()
    {
        // Act
        $result = $this->SUT->resolve('foo', 'foo');

        // Assert
        $this->assertEquals(new Token('foo'), $result);
    }

    /**
     * @test
     */
    public function itShouldNotResolveASimpleTokenThatDoesNotMatch()
    {
        // Act
        $result = $this->SUT->resolve('foo', 'bar');

        // Assert
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function itShouldResolveATokenWithoutRequirementNorDefault()
    {
        // Act
        $result = $this->SUT->resolve('{name}', 'value');

        // Assert
        $this->assertEquals(new Token('value', 'name'), $result);
    }

    /**
     * @test
     */
    public function itShouldResolveATokenWithRequirement()
    {
        // Act
        $result = $this->SUT->resolve('{year}', '2020', ['year' => '\d+']);

        // Assert
        $this->assertEquals(new Token('2020', 'year'), $result);
    }

    /**
     * @test
     */
    public function itShouldNotResolveATokenWithRequirementThatDoesNotMatch()
    {
        // Act
        $result = $this->SUT->resolve('{month}', 'june', ['month' => '\d+'], null);

        // Assert
        $this->assertFalse($result);
    }
}
