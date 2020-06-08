<?php

namespace MagicFramework\Router\Configuration;

use MagicFramework\Router\Route;
use MagicFramework\Router\RouteCollection;
use Symfony\Component\Yaml\Yaml;

class YamlConfigurationLoader
{
    /**
     * @param $configurationFile
     * @return RouteCollection
     */
    public function load($configurationFile): RouteCollection
    {
        $configuredRoutes = Yaml::parse(file_get_contents($configurationFile));
        $routeCollection = new RouteCollection();

        foreach ($configuredRoutes as $name => $config) {
            // TODO assert & validate the config
            $routeCollection->add($name, new Route(
                $config['controller'],
                $config['path'],
                $config['requirements'] ?? []
            ));
        }

        return $routeCollection;
    }
}
