<?php


namespace App\Services;

use App\Events\NotificationCount;
use App\Exceptions\CommentException;
use App\Exceptions\PostException;
use App\Http\Controllers\CacheClearController;
use App\Http\Controllers\NotificationController;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;

class CommentService
{

    public function comment(Request $request, string $id)
    {
        $user = auth()->user();
        $post = Post::find($id);
        $postOwner = User::find($post->userId);

        CacheClearController::Post();
        CacheClearController::CommentClear($id);
        CacheClearController::UserPosts($user->id);
        CacheClearController::UserDetailClear($user->id);
        CacheClearController::NotificationClear($postOwner->id);

        if (!$post) {
            throw new PostException('No Post Found For Commenting.', 404, null, false);
        }

        $transaction = \DB::transaction(function () use ($user, $post, $request, $id,$postOwner) {

            $comment = Comment::create([
                'content' => $request->content,
                'userId' => $user->id,
                'postId' => $id,
            ]);

            if (!$comment) {
                throw new CommentException('Something Went Wrong, Please try again later.', 500, null, true);
            }

            $us = User::find($post->userId);
            if ($user->id != $us->id) {


                $data = json_encode(['user_id' => $us->id, 'comment_id' => $comment->id, 'post_id' => (int)$id]);
                Notification::create([
                    'userId' => $user->id,
                    'type' => 'SentComment',
                    'data' => $data,

                ]);
                $us->notify(new CommentNotification($user, $post));
                NotificationController::CountNotificationBroadcast($postOwner->id);
                return $comment;
            }

        });
        return response()->json($transaction, 200);
    }

    public function deleteComment(string $id)
    {
        $user = auth()->id();

        $cacheId = Comment::where('id', $id)->value('postId');

        CacheClearController::Post();
        CacheClearController::CommentClear($cacheId);
        CacheClearController::UserDetailClear($user->id);
        CacheClearController::NotificationClear($cacheId->id);


        $comment = Comment::find($id);
        if (!$comment) {
            throw new CommentException('No Comment Found to Deleting.', 404, null, false);
        }
        return \DB::transaction(function () use ($comment, $id) {
            $chk = $comment->delete();
            Notification::where('type', 'SentComment')
                ->whereJsonContains('data', ['comment_id' => (int)$id])->delete();
            return response()->json("Comment Deleted!", 200);
        });
    }

    public function showCommentByPost(string $id)
    {
        $cacheKey = 'post.comments.' . $id;

        $comments = \Cache::remember($cacheKey, 600, function () use ($id) {
            return Comment::where('postId', $id)->with('user')->latest()->get();
        });

        if ($comments->count() == 0) {
            throw new CommentException('No Comments Yet.', 404, null, false);
        }

        $flattenedComments = $comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'userId' => $comment->userId,
                'postId' => $comment->postId,
                'content' => $comment->content,
                'created_at' => $comment->created_at,
                'updated_at' => $comment->updated_at,
                'userId' => $comment->user->id,
                'name' => $comment->user->name,
                'profilepicture' => asset('images/' . $comment->user->profilepicture),
                'bio' => $comment->user->bio
            ];
        });

        return response()->json($flattenedComments, 200);
    }
}
