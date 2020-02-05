<?php

use Phalcon\Di;
use Phalcon\Mvc\Micro;
use App\Providers\AppProvider;
use App\Providers\RouteProvider;
use App\Providers\MiddlewareProvider;


require_once __DIR__ . '/constants.php';

require_once BASE . '/vendor/autoload.php';


$config = require_once __DIR__ . '/configs.php';


if($config->app->debug) {
    ini_set('display_errors', 1);
    ini_set('displaystartuperrors', 1);
    error_reporting(E_ALL);
}


require_once __DIR__ . '/helpers.php';


require_once __DIR__ . '/loader.php';


require_once __DIR__ . '/services.php';


$provider = new AppProvider($container);
$provider->registerServices();


$application = new Micro($container);


$routeProvider = new RouteProvider($application);
$application = $routeProvider->load();


$middlewareProvider = new MiddlewareProvider($application);
$application = $middlewareProvider->load();

return $application;