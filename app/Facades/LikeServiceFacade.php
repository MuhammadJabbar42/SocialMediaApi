<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class LikeServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "like-service";
    }
}