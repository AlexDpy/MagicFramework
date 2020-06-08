<?php

namespace MagicFramework\Router;

class Route
{
    /** @var string  */
    private $controller;
    /** @var string  */
    private $path;
    /** @var string[] */
    private $requirements;
//    private $host = '';
//    private $schemes = [];
//    private $methods = [];
//    private $defaults = [];
//    private $options = [];
//    private $condition = '';
    /** @var string[] */
    private $params = [];

    public function __construct(string $controller, string $path, array $requirements = [])
    {
        $this->controller = $controller;
        $this->path = $path;
        $this->requirements = $requirements;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string[]
     */
    public function getRequirements(): array
    {
        return $this->requirements;
    }

    public function getController(): string
    {
        return $this->controller;
    }
}
