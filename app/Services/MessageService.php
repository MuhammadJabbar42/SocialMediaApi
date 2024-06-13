<?php

namespace App\Services;


use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageService
{
    public function getMessage()
    {
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
       return DB::transaction(function () use ($request) {
            $message = Message::create([
                'senderId' => Auth::id(),
                'reciverId' => $request->reciverId,
                'content' => $request->content
            ]);
            broadcast(new MessageSent($message))->toOthers();
            return response()->json(['message' => 'Message sent successfully', 'data' => $message], 201);
        });
    }
}
