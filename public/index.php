<?php

require 'vendor/autoload.php';

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();


$kernel = new \MagicFramework\Kernel();
$response = $kernel->handle($request);
// TODO send response @see https://github.com/slimphp/Slim/blob/5613cbb521081ed676d5d7eb3e44f2b80a818c24/Slim/ResponseEmitter.php


