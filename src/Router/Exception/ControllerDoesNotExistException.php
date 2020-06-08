<?php

namespace MagicFramework\Router\Exception;

class ControllerDoesNotExistException extends RouterException
{
    public function __construct($class, $method)
    {
        parent::__construct(sprintf('Controller %s::%s does not exist', $class, $method));
    }
}
