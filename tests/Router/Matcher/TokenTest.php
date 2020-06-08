<?php

namespace Test\MagicFramework\Router\Matcher;

use MagicFramework\Router\Matcher\Token;
use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    /**
     * @test
     */
    public function isParametrized()
    {
        $this->assertEquals(false, (new Token('value without parameterName'))->isParametrized());
        $this->assertEquals(true, (new Token('value', 'name'))->isParametrized());
    }
}
