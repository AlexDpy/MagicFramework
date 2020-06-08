<?php

require __DIR__ . '/../vendor/autoload.php';

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();

$kernel = new \MagicFramework\Kernel();
$response = $kernel->handle($request);

/**
 * I copied the ResponseEmitter class from Slim Framework https://github.com/slimphp/Slim/blob/5613cbb521081ed676d5d7eb3e44f2b80a818c24/Slim/ResponseEmitter.php
 * So I can correctly send the response with all the needed headers and streams
 */
(new \MagicFramework\Util\ResponseEmitter())->emit($response);
