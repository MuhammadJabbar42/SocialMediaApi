<?php

namespace App\Services;

use App\Models\Like;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use App\Notifications\LikeNotification;

class LikeService 
{
    public function like(string $id)
    {
        $user = auth()->user();
        $post = Post::find($id);
        if(!$post)
        {
            return response()->json("Post Not Found!",404);            
        }
        $existLike = Like::where('userId',$user->id)
        ->where('postId',$id)->exists();
        if($existLike)
        {
            return response()->json("Already You Like it!",409);
        }

        $like = Like::create([
            'userId'=>$user->id,
            'postId'=>$post->id,
        ]);         
        $post->likes()->attach($like);

        
        if($post)
        {
            $postOwner = User::find($post->userId);
            if($user->id != $post->userId)
            {
            $data = json_encode(['user_id' => $postOwner->id, 'post_id' => $post->id]);
            Notification::create([
                'userId' => $user->id,
                'type'=>'SentLike',
                'data' => $data,
                
            ]);
            $postOwner->notify(new LikeNotification($user,$post));
            }
            return response()->json(["Liked!"],200);
        }
        return response()->json("Something went wrong!",500);
    }

    public function unlike(string $id)
    {
    $user = auth()->user();
    $post = Post::find($id);
    $us = User::find($post->userId);
    $post->likes()->detach($user->id); 
    $lk = Like::where('postId',$id)->delete();
    Notification::where('type','SentLike')
    ->whereJsonContains('data',['user_id'=>$us->id])
    ->whereJsonContains('data',['post_id'=>(int)$id])
    ->delete();    
    if($lk)
    {
        return response()->json("Unliked!",200);
    }
    else
    {
        return response()->json("Already Unliked!",400);

    }
    }

}