<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;
use App\Controllers\TaskController;

$collection = new MicroCollection();

$collection->setHandler(TaskController::class, true);

$collection->setPrefix('/NfAPGTGBPsrZfROqtfK20BhGfroXaL5X/');

$collection->get('send_notification', 'sendNotification');

$this->app->mount($collection);