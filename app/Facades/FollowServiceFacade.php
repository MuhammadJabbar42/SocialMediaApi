<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class FollowServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'follow-service';
    }
}