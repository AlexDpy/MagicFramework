<?php

require 'vendor/autoload.php';

//$route = new \MagicFramework\Router\Route('Controller::method', '', []);
//die(PHP_EOL . 'die() at "' . __FILE__ . ':' . __LINE__ . '"' . PHP_EOL);

//$route = new \MagicFramework\Router\Route('Controller::method', '/', []);
//die(PHP_EOL . 'die() at "' . __FILE__ . ':' . __LINE__ . '"' . PHP_EOL);

$route = new \MagicFramework\Router\Route('Controller::method', '/blog/{year}/{month}/{day}', []);
die(PHP_EOL . 'die() at "' . __FILE__ . ':' . __LINE__ . '"' . PHP_EOL);
