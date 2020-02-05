<?php

namespace App\Providers;

use Phalcon\Mvc\Micro;

use App\Controllers\HomeController;

class RouteProvider
{

    protected $app;
    

    protected $collection;

    public function __construct(Micro $app)
    {
        $this->app = $app;
    }
    
    public function load() 
    {
        $this->app = $this->map();

        return $this->app;
    }


    public function map()
    {
        return $this->mapRoutes();
    }

    public function mapRoutes()
    {
        return require_once app_path('routes/routes.php');
    }
}