<?php

namespace MagicFramework\Router\Exception;

use Psr\Http\Message\RequestInterface;

class RequestDidNotMatchException extends RouterException
{
    public function __construct(RequestInterface $request)
    {
        parent::__construct(sprintf('The request with path %s did not match with any route', $request->getUri()->getPath()));
    }
}
