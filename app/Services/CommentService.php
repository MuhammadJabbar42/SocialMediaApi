<?php


namespace App\Services;

use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;

class CommentService 
{

    public function comment(Request $request,string $id)
    {
        $user = auth()->user();
        $post = Post::find($id);
        if(!$post)
        {
            return response()->json("Post Not Found!",400);
        }
        $comment = Comment::create([
            'content'=>$request->content,
            'userId'=>$user->id,
            'postId'=>$id,
        ]);
        if($comment)
        {
            $us = User::find($post->userId);
            $data = json_encode(['user_id' => $us->id, 'comment_id' => $comment->id , 'post_id'=>(int) $id]);
            Notification::create([
                'userId' => $user->id,
                'type'=>'SentComment',
                'data' => $data,
                
            ]);  
            $us->notify(new CommentNotification($user,$post));
            return response()->json($comment,200);
        }
        
    }
    public function deleteComment(string $id)
    {
        $comment = Comment::find($id);
        if(!$comment)
        {
            return response()->json("Comment Not Found!",400);
        }
        $comment->delete();
        Notification::where('type','SentComment')
            ->whereJsonContains('data',['comment_id'=>(int)$id])->delete();
        return response()->json("Comment Deleted!",200);
    }
    public function showCommentByPost(string $id)
    {

        // $users = User::where('profilepicture',NULL)->get();
        // $users=$users->map(function($user){
        //     $user->profilepicture = 'dummy.jpg';
        //     $user->save();
        // });
        
        $comments = Comment::where('postId', $id)->with('user')->Latest()->get();
            if($comments->count()==0)
            {
                return response()->json(["Message"=>'No Comments Yet'],404);
            }
        $flattenedComments = $comments->map(function($comment) {
            return [
                'id' => $comment->id,
                'userId' => $comment->userId,
                'postId' => $comment->postId,
                'content' => $comment->content,
                'created_at' => $comment->created_at,
                'updated_at' => $comment->updated_at,
                'userId' => $comment->user->id,
                'name' => $comment->user->name,
                'profilepicture' => asset('images/'.$comment->user->profilepicture),
                'bio' => $comment->user->bio
            ];
        });
    
        return response()->json($flattenedComments, 200);
    }

}