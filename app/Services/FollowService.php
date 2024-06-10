<?php

namespace App\Services;

use App\Models\Follow;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\FollowNotification;

class FollowService 
{
    public function follow(string $id)
    {
        $user = auth()->user();
        if($user->id == $id)
        {
            return response()->json('You cannot follow yourself!',400);
        }
        // $ex = User::find($id);
        // if(!$ex)
        // {
        //     return response()->json('User not found!',400);
        // }
        // if($user->id == $id)
        // {
        //     return response()->json('You cannot follow yourself!',400);
        // }
        // $follow = Follow::create([
        //     'followerId'=>$user->id,
        //     'followeeId'=>$id,
        // ]);
        
        // if($follow)
        // {
        //     return response()->json('Followed!',200);
        // }
        // return response()->json('Something Went Wrong!',400);
            
        $existingRelation = Follow::where('followerId',$user->id)->where('followeeId',$id)->first();
            if($existingRelation)
            {
                return response()->json('Already Followed!',400);
            }
            Follow::create([
                'followerId'=>$user->id,
                'followeeId'=>$id,
            ]);
            $us = User::find($id);
            $data = json_encode(['follower_id' => $user->id, 'followee_id' => $us->id]);
            Notification::create([
                'userId' => $user->id,
                'type'=>'SentFollow',
                'data' => $data,
                
            ]);            
            $us->notify(new FollowNotification($user,$us));
            return response()->json('Followed!', 200);


    }
    public function unfollow(string $id)
    {
        $user = auth()->user();
        Follow::where('followerId', $user->id)
        ->where('followeeId', $id)
        ->delete();
        Notification::where('type','SentFollow')
        ->whereJsonContains('data',['follower_id'=>$user->id])
        ->whereJsonContains('data',['followee_id'=>(int)$id])
        ->delete();
        return response()->json('Unfollowed!', 200);
    }
    public function followers()
    {
        $user = auth()->user();
        $followers = $user->followers()->with('follower')->get()->pluck('follower');
        return response()->json($followers, 200);

    }
    public function following()
    {
        $user = auth()->user();

        $following = $user->following()->with('followee')->get()->pluck('followee');

        return response()->json($following, 200);
    }    
}