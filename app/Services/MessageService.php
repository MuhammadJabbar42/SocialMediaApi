<?php

namespace App\Services;

use App\Events\MessageSent;
use App\Exceptions\MessageException;
use App\Http\Controllers\CacheClearController;
use App\Mail\ExceptionOccured;
use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageService
{
    public function getMessage()
    {
        $userId = Auth::id();
        $cacheKey = 'user.messages.' . $userId;

        $messages = \Cache::remember($cacheKey, 600, function () use ($userId) {
            return Message::where('reciverId', $userId)
                ->with('sender', 'reciver')
                ->orWhere('senderId', $userId)
                ->orderBy('created_at', 'desc')
                ->get();
        });

        if ($messages->count() <= 0) {
            throw new MessageException('No Messages Yet', 404);
        }

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $userId = Auth::id();
        CacheClearController::Messageclear($userId);
        $request->validate([
            'reciverId' => 'required|exists:users,id',
            'content' => 'required|string|max:255',
        ]);
        try {


            return DB::transaction(function () use ($request) {
                $message = Message::create([
                    'senderId' => Auth::id(),
                    'reciverId' => $request->reciverId,
                    'content' => $request->content,
                ]);
                broadcast(new MessageSent($message))->toOthers();
                return response()->json(['message' => 'Message sent successfully', 'data' => $message], 201);
            });
        } catch (\Illuminate\Broadcasting\BroadcastException $e) {
            \Log::error('BroadcastException: ' . $e->getMessage());
            \Mail::to('mj8667941@gmail.com')->send(new ExceptionOccured($e));

            return response()->json([
                'message' => 'Failed to broadcast message, please try again later.',
            ], 500);
        } catch (\Exception $e) {
            \Log::error('GeneralException: ' . $e->getMessage());

            return response()->json([
                'message' => 'An unexpected error occurred, please try again later.',
            ], 500);
        }
    }

}
