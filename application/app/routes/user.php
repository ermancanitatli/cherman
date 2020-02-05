<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;
use App\Controllers\UserController;

$collection = new MicroCollection();

$collection->setHandler(UserController::class, true);

$collection->setPrefix('/user/');

$collection->put('update', 'update');
$collection->post('refresh', 'refresh');
$collection->post('password', 'updatePassword');

$this->app->mount($collection);