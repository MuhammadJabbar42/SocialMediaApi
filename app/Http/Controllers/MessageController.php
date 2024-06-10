<?php

namespace App\Http\Controllers;

use App\Events\JustTest;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
   public function getMessages()
   {
    // $messages = Message::where('reciverId', Auth::id())
    // ->orWhere('senderId', Auth::id())
    // ->orderBy('created_at', 'desc')
    // ->get();

    // return response()->json($messages);

    $messages = Message::where('reciverId', Auth::id())
    ->with('sender', 'reciver')
    ->orWhere('senderId', Auth::id())
    ->orderBy('created_at', 'desc')
    ->get();

    return response()->json($messages);    
   }

   public function sendMessage(Request $request)
   {

    $request->validate([
        'reciverId' => 'required|exists:users,id',
        'content' => 'required|string|max:255',    
    ]);
    $message = Message::create([
        'senderId'=>Auth::id(),
        'reciverId'=>$request->reciverId,
        'content'=>$request->content
    ]);
    broadcast(new MessageSent($message))->toOthers();
    // broadcast(new JustTest($message))->toOthers();
    return response()->json(['message' => 'Message sent successfully', 'data' => $message], 201);
    }
   
   
}
