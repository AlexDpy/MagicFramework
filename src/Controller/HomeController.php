<?php

namespace MagicFramework\Controller;

use GuzzleHttp\Psr7\Response;
use MagicFramework\Template\Renderer;

class HomeController
{
    /**
     * @var Renderer
     */
    private $renderer;

    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function homepage()
    {
        return new Response(200, [], $this->renderer->render(
            'home_homepage.html'
        ));
    }
}
