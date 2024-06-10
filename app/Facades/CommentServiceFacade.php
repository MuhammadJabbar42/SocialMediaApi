<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CommentServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "comment-service";
    }
}