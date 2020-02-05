<?php

namespace App\Providers;

use Phalcon\DI\FactoryDefault;
use App\Repositories\UserRepository;
use App\Presenters\UserPresenter;
use App\Services\UserService;
use App\Models\User as UserModel;

class AppProvider extends AbstractAppProvider
{

    protected $di;
    
    public function __construct(FactoryDefault $di)
    {
        $this->di = $di;
    }
    

    public function repositories() 
    {
        $this->bindRepository('userRepository', UserRepository::class, [new UserModel]);
    }


    public function services() 
    {
        $this->bindService('userService', UserService::class, [$this->getDi()->get('userRepository')]);
    }



    public function presenters() 
    {
        $this->bindRepository('userPresenter', UserPresenter::class, [new UserModel]);
    }
}