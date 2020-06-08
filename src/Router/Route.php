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
    /** @var string[] */
    private $defaults;

    /**
     * Route constructor.
     * @param string $controller
     * @param string $path
     * @param string[] $requirements
     * @param string[] $defaults
     */
    public function __construct(
        string $controller,
        string $path,
        array $requirements = [],
        array $defaults = []
    ) {
        $this->controller = $controller;
        $this->path = $path;
        $this->requirements = $requirements;
        $this->defaults = $defaults;
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

    public function getDefaults(): array
    {
        return $this->defaults;
    }
}
