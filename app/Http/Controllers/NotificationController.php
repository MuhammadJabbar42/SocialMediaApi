<?php

namespace App\Http\Controllers;

use App\Events\NotificationCount;
use App\Exceptions\UserException;
use App\Models\Notification;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\User;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function NotificationHistory()
    {
        $user = auth()->user();
        CacheClearController::NotificationClear($user->id);
        $notification = Notification::whereJsonContains('data', ['user_id' => $user->id])
            ->orderBy('created_at', 'desc')
            ->get();
        if (empty($notification)) {
            throw new UserException('No Notification Yet.', 404, null, false);
        }

        $notification = $notification->map(function ($notf) {

            $message = "";
            $name = "";
            $us = User::find($notf->userId);

            if ($notf->type == 'SentLike') {
                $message = 'Liked Your Post';
                $name = $us->name;
            } elseif ($notf->type == 'SentComment') {
                $message = 'Commented on Your Post';
                $name = $us->name;
            } elseif ($notf->type == 'SentFollow') {
                $message = 'Followed You';
                $name = $us->name;
            }
            return [
                'name' => $name,
                'message' => $message,
                'profilepicture' => asset('images/' . $us->profilepicture),
                'created_at' => $notf->created_at,


            ];

        });
        return response()->json($notification, 200);
    }

    public function CountUnreadNotification()
    {
        $user = auth()->user();
        $cacheKey = 'user.notification.'.$user->id;
        \Cache::forget($cacheKey);

        $cache = \Cache::remember($cacheKey,60*10,function () use($user){
            return  Notification::whereJsonContains('data', ['user_id' => $user->id])
                ->where('read_at', null)
                ->count();

        });

        broadcast(new NotificationCount($cache,$user->id))->toOthers();

        return response()->json(['count' => $cache], 200);
    }

    static public function CountNotificationBroadcast($id)
    {
        $cacheKey = 'user.notification.'.$id;
        \Cache::forget($cacheKey);

        $cache = \Cache::remember($cacheKey,60*10,function () use($id){
            return  Notification::whereJsonContains('data', ['user_id' => $id])
                ->where('read_at', null)
                ->count();

        });

        broadcast(new NotificationCount($cache,$id))->toOthers();

        //return response()->json(['count' => $cache], 200);
    }

    public function SeenNotification()
    {
        $user = auth()->user();
        CacheClearController::NotificationClear($user->id);
        $notifications = Notification::whereJsonContains('data', ['user_id' => $user->id])
            ->whereNull('read_at')
            ->get();

        $notifications->each(function ($notification) {
            $notification->read_at = Carbon::now();
            $notification->save();
        });

    }

}
