<?php

namespace MagicFramework\Controller;

use GuzzleHttp\Psr7\Response;
use MagicFramework\Template\Renderer;

class BlogController
{
    /**
     * @var Renderer
     */
    private $renderer;

    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function view($year, $month, $day)
    {
        return new Response(200, [], $this->renderer->render(
            'blog_view.html',
            [
                'year' => $year,
                'month' => $month,
                'day' => $day,
            ]
        ));
    }
}
