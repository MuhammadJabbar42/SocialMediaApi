<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MessageServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'message-service';
    }
}