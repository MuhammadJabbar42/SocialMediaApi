<?php

namespace App\Services;

use App\Exceptions\FollowException;
use App\Http\Controllers\CacheClearController;
use App\Http\Controllers\NotificationController;
use App\Models\Follow;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\FollowNotification;
use Illuminate\Support\Facades\DB;

class FollowService
{
    public function follow(string $id)
    {
        $user = auth()->user();

        CacheClearController::Post();
        CacheClearController::UserDetailClear($user->id);
        CacheClearController::UserDetailClear($id);
        CacheClearController::NotificationClear($id);

        if ($user->id == $id) {
            throw new FollowException('You Cannot Follow YourSelf.', 400, null, false);
        }


        $existingRelation = Follow::where('followerId', $user->id)->where('followeeId', $id)->first();
        if ($existingRelation) {
            throw new FollowException('Already Followed.', 409, null, false);
        }
        $transaction = DB::transaction(function () use ($user, $id) {
            Follow::create([
                'followerId' => $user->id,
                'followeeId' => $id,
            ]);
            $us = User::find($id);
            $data = json_encode(['follower_id' => $user->id, 'user_id' => $us->id]);
            Notification::create([
                'userId' => $user->id,
                'type' => 'SentFollow',
                'data' => $data,

            ]);
            $us->notify(new FollowNotification($user, $us));
            NotificationController::CountNotificationBroadcast($id);
            return ['message' => 'Followed.'];
        });
        return response()->json($transaction, 200);
    }

    public function unfollow(string $id)
    {
        $user = auth()->user();

        CacheClearController::Post();
        CacheClearController::UserDetailClear($user->id);
        CacheClearController::UserDetailClear($id);
        CacheClearController::NotificationClear($id);

        $transaction = DB::transaction(function () use ($user, $id) {
            $fl = Follow::where('followerId', $user->id)
                ->where('followeeId', $id)
                ->delete();
            if (!$fl) {
                throw new FollowException('There is nothing to unfollow.', 404, null, false);
            }
            Notification::where('type', 'SentFollow')
                ->whereJsonContains('data', ['follower_id' => $user->id])
                ->whereJsonContains('data', ['user_id' => (int)$id])
                ->delete();
            NotificationController::CountNotificationBroadcast($id);
            return ['message' => 'Unfollowed.'];
        });
        return response()->json($transaction, 200);
    }

    public function followers()
    {
        $user = auth()->user();
        if ($user->followers()->count() <= 0) {
            throw new FollowException("You Don't have any followers.", 404, null, false);
        }
        $followers = $user->followers()->with('follower')->get()->pluck('follower');

        return response()->json($followers, 200);
    }

    public function following()
    {
        $user = auth()->user();
        if ($user->following()->count() <= 0) {
            throw new FollowException("You Didn't follow anyone.", 404, null, false);
        }
        $following = $user->following()->with('followee')->get()->pluck('followee');

        return response()->json($following, 200);
    }
}
