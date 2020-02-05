<?php

namespace App\Middleware;

use Phalcon\Events\Event;
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class FirewallMiddleware implements MiddlewareInterface
{

    public function beforeHandleRoute(Event $event, Micro $application)
    {

        return true;
    }


    public function call(Micro $application)
    {
        return true;
    }
}