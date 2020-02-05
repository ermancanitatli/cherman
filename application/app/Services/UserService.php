<?php

namespace App\Services;

class UserService
{

    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function test()
    {
        return 'user service test';
        // return $this->repository->test();
    }
}
