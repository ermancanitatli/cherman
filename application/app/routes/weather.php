<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;
use App\Controllers\WeatherController;

$collection = new MicroCollection();

$collection->setHandler(WeatherController::class, true);

$collection->setPrefix('/weather/');

$collection->get('info', 'getInfo');

$this->app->mount($collection);