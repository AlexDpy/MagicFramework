<?php

namespace MagicFramework\Router\Configuration;

use MagicFramework\Router\Exception\BadConfigurationException;
use MagicFramework\Router\Route;
use MagicFramework\Router\RouteCollection;
use Symfony\Component\Yaml\Parser;

class YamlConfigurationLoader
{
    /**
     * @var Parser
     */
    private $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param $configurationFile
     * @return RouteCollection
     */
    public function load($configurationFile): RouteCollection
    {
        $configuredRoutes = $this->parser->parse(file_get_contents($configurationFile));
        $routeCollection = new RouteCollection();

        foreach ($configuredRoutes as $name => $config) {
            if (!isset($config['controller'])) {
                throw new BadConfigurationException(sprintf('A controller is needed in the "%s" route configuration', $name));
            }
            if (!isset($config['path'])) {
                throw new BadConfigurationException(sprintf('A path is needed in the "%s" route configuration', $name));
            }

            $routeCollection->add($name, new Route(
                $config['controller'],
                $config['path'],
                $config['requirements'] ?? [],
                $config['defaults'] ?? []
            ));
        }

        return $routeCollection;
    }
}
