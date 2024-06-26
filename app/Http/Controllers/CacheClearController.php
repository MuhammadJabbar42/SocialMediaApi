<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CacheClearController extends Controller
{
    static public function UserDetailClear($id)
    {
        $cacheKey = 'user.details.' . $id;
        \Cache::forget($cacheKey);
    }

    static public function Post()
    {
        $cacheKey = 'posts.latest';
        \Cache::forget($cacheKey);

    }

    static public function UserPosts($id)
    {
        $cacheKey = 'user.posts.' . $id;
        \Cache::forget($cacheKey);

    }

    static public function Messageclear($id)
    {
        $cacheKey = 'user.messages.' . $id;
        \Cache::forget($cacheKey);
    }
    static public function CommentClear($id)
    {
        $cacheKey = 'post.comments.' . $id;
        \Cache::forget($cacheKey);
    }
    static public function NotificationClear($id)
    {
        $cacheKey = 'user.notification.'.$id;
        \Cache::forget($cacheKey);

    }

}
