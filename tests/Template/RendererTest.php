<?php

namespace Test\MagicFramework\Template;

use MagicFramework\Template\Renderer;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{
    /** @var Renderer */
    private $SUT;

    protected function setUp(): void
    {
        $this->SUT = new Renderer(__DIR__ . '/views/');
    }

    /**
     * @test
     */
    public function itShouldRenderTheTemplate()
    {
        // Act
        $result = $this->SUT->render('fake_view.txt', ['name' => 'Alice']);

        // Assert
        $this->assertEquals("Hello Alice\n", $result);
    }
}
