<?php

namespace MagicFramework\Controller;

use GuzzleHttp\Psr7\Response;

class BlogController
{
    public function view($year, $month, $day)
    {
        return new Response(200, [], "day:$day|month:$month|year:$year");
    }
}
