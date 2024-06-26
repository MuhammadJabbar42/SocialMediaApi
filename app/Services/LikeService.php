<?php

namespace App\Services;

use App\Events\NotificationCount;
use App\Exceptions\LikeException;
use App\Exceptions\PostException;
use App\Http\Controllers\CacheClearController;
use App\Http\Controllers\NotificationController;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use App\Notifications\LikeNotification;
use Illuminate\Support\Facades\DB;

class LikeService
{
    public function like(string $id)
    {
        $user = auth()->user();
        $post = Post::find($id);
        $postOwner = User::find($post->userId);

        CacheClearController::Post();
        CacheClearController::UserDetailClear($postOwner->id);
        CacheClearController::UserDetailClear($user->id);
        CacheClearController::UserPosts($user->id);
        CacheClearController::UserPosts($postOwner->id);
        CacheClearController::NotificationClear($postOwner->id);

        if (!$post) {
            throw new PostException('No Post Found.', 404, null, false);
        }
        $existLike = Like::where('userId', $user->id)
            ->where('postId', $id)->exists();
        if ($existLike) {
            throw new LikeException('You Already Liked.', 409, null, false);
        }
        $transaction = DB::transaction(function () use ($user, $post, $postOwner) {
            $like = Like::create([
                'userId' => $user->id,
                'postId' => $post->id,
            ]);
            $post->likes()->attach($like);


            if ($user->id != $post->userId) {
                $data = json_encode(['user_id' => $postOwner->id, 'post_id' => $post->id]);
                Notification::create([
                    'userId' => $user->id,
                    'type' => 'SentLike',
                    'data' => $data,

                ]);
                $postOwner->notify(new LikeNotification($user, $post));
                NotificationController::CountNotificationBroadcast($postOwner->id);
            }
            return ['message' => "Liked!"];
        });
        if (!$transaction) {
            throw new LikeException('Something went wrong, please try again later.', 500);
        }
        return response()->json($transaction, 200);

    }

    public function unlike(string $id)
    {
        $user = auth()->user();

        $post = Post::find($id);
        $us = User::find($post->userId);

        CacheClearController::UserPosts($us->id);
        CacheClearController::Post();
        CacheClearController::UserDetailClear($us->id);
        CacheClearController::UserDetailClear($user->id);
        CacheClearController::UserPosts($user->id);
        CacheClearController::NotificationClear($us->id);

        $transaction = DB::transaction(function () use ($user, $post, $id, $us) {
            $post->likes()->detach($user->id);

            $lk = Like::where('postId', $id)->delete();
            Notification::where('type', 'SentLike')
                ->whereJsonContains('data', ['user_id' => $us->id])
                ->whereJsonContains('data', ['post_id' => (int)$id])
                ->delete();
            if (!$lk) {
                throw new LikeException('Already Unliked.', 400, null, false);
            }
            NotificationController::countNotificationBroadcast($us->id);
            return ['message' => 'Unliked.'];
        });
        return response()->json($transaction, 200);
    }
}
