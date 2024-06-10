<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PostServiceFacade extends Facade
{
 protected static function getFacadeAccessor()
 {
    return 'post-service';
 }
}