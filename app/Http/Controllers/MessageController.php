<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use App\Facades\MessageServiceFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
   public function getMessages()
   {
    return MessageServiceFacade::getMessage();
   }

   public function sendMessage(Request $request)
   {
    return MessageServiceFacade::sendMessage($request);
   }
   
   
}
