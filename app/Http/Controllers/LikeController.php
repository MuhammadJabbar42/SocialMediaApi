<?php

namespace App\Http\Controllers;

use App\Facades\LikeServiceFacade;
use App\Models\Like;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;

class LikeController extends Controller
{
   public function like(string $id)
   {
    return LikeServiceFacade::like($id);
   }
   public function unlike(string $id)
   {
    return LikeServiceFacade::unlike($id);
   }
}
