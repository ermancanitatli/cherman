<?php

namespace App\Middleware;

use Phalcon\Events\Event;
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class RequestMiddleware implements MiddlewareInterface
{

    public function beforeExecuteRoute(Event $event, Micro $application)
    {
        return true;
    }


    public function call(Micro $application)
    {
        return true;
    }
}