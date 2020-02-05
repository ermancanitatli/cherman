<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;
use App\Controllers\GiftController;

$collection = new MicroCollection();

$collection->setHandler(GiftController::class, true);

$collection->setPrefix('/gift/');

$collection->post('take', 'takeGift');

$this->app->mount($collection);