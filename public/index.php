<?php

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance Mode
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composer autoloader
require __DIR__.'/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

/** @var Kernel $kernel */
$kernel = $app->make(Kernel::class);

// Handle Request
$request = Request::capture();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
