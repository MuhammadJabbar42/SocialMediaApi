<?php

namespace App\Http\Controllers;

use App\Facades\FollowServiceFacade;
use App\Models\Follow;
use App\Http\Requests\StoreFollowRequest;
use App\Http\Requests\UpdateFollowRequest;

class FollowController extends Controller
{
   public function follow(string $id)
   {
    return FollowServiceFacade::follow($id);
   }
   public function unfollow(string $id)
   {
    return FollowServiceFacade::unfollow($id);
   }
   public function followers()
   {
      return FollowServiceFacade::followers();
   }
   public function following()
   {
      return FollowServiceFacade::following();
   }

}
