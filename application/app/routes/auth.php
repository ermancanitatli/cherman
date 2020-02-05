<?php 

use Phalcon\Mvc\Micro\Collection as MicroCollection;
use App\Controllers\AuthController;

$collection = new MicroCollection();

$collection->setHandler(AuthController::class, true);

$collection->setPrefix('/auth/');

$collection->post('register', 'register');
$collection->post('refresh', 'refresh');
$collection->post('login', 'login');

$this->app->mount($collection);