<?php

namespace App\Services;

use App\Exceptions\PostException;
use App\Http\Controllers\CacheClearController;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostService
{

    public function show()
    {
        $cacheKey = 'posts.latest';
        $posts = \Cache::remember($cacheKey, 3600, function () {

            $posts = Post::withCount(['likes', 'comments'])
                ->latest()
                ->get();

            if ($posts->isEmpty()) {
                throw new PostException('No posts made yet.', 404, null, false);
            }

            $posts = $posts->map(function ($post) {
                $post->user->profilepicture = asset('images/' . $post->user->profilepicture);
                $post->image = asset('posts/' . $post->image);

                $user = User::with(['followers', 'following', 'posts'])
                    ->find($post->userId);
                $userr = auth()->user();

                $liked = Like::where('userId', $userr->id)
                    ->where('postId', $post->id)
                    ->exists();
                $post->user->followers_count = $user->followers()->count();
                $post->user->following_count = $user->following()->count();
                $post->user->post_count = $user->posts()->count();
                $post->liked = $liked;


                return $post;
            });

            return $posts;
        });

        return response()->json($posts, 200);
    }

    public function makePost(Request $request)
    {
        $user = auth()->user();

        CacheClearController::Post();
        CacheClearController::UserPosts($user->id);
        CacheClearController::UserDetailClear($user->id);

        $image = $request->file('image');
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('posts'), $imageName);
        $post = Post::create([
            'userId' => $user->id,
            'content' => $request->content,
            'image' => $imageName,

        ]);

        if (!$post) {
            throw new PostException('Failed to creating The post, Please try again', 500);
        }

        return response()->json([
            'Message' => 'Post Has Been Created Successfully!',
            'Data' => $post,
        ], 201);
    }

    public function updatePost(Request $request)
    {

        $user = auth()->user();

        CacheClearController::Post();
        CacheClearController::UserDetailClear($user->id);
        CacheClearController::UserPosts($user->id);

        $post = Post::where('userId', $user->id)->where('id', $request->id)->first();
        $post->update([
            'content' => $request->content,
            'image' => $request->image,
        ]);
        if (!$post) {
            throw new PostException('Failed to updating The post, Please try again', 500);
        }

        return response()->json(['Message' => 'Post Has Been Updated Successfully!'], 200);
    }

    public function deletePost(Request $request)
    {
        $user = auth()->user();

        CacheClearController::Post();
        CacheClearController::UserDetailClear($user->id);
        CacheClearController::UserPosts($user->id);

        $post = Post::where('userId', $user->id)->where('id', $request->id)->first();
        $post->delete();
        if (!$post) {
            throw new PostException('Failed to deleting The post, Please try again', 500);
        }

        return response()->json(['Message' => 'Post Has Been Deleted Successfully!'], 200);
    }


    public function onePostByUser()
    {
        $cacheKey = 'user.posts.' . auth()->id();

        $posts = \Cache::remember($cacheKey, 3600, function () {

            $user = auth()->user();
            $posts = Post::withCount(['likes', 'comments'])
                ->where('userId', $user->id)
                ->latest()
                ->get();

            if ($posts->isEmpty()) {
                throw new PostException('You don\'t have any posts.', 404, null, false);
            }

            $posts = $posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'content' => $post->content,
                    'image' => asset('posts/' . $post->image),
                    'created_at' => $post->created_at,
                    'updated_at' => $post->updated_at,
                    'likes_count' => $post->likes_count,
                    'comments_count' => $post->comments_count,
                    'profilepicture' => asset('images/' . $post->user->profilepicture),
                    'name' => $post->user->name,
                    'bio' => $post->user->bio,
                ];
            });

            return $posts;
        });

        return response()->json($posts, 200);

    }

    public function onePost(string $id)
    {
        $post = Post::where('id', $id)->first();
        if (!$post) {
            throw new PostException('Post Not Found!', 404, null, false);
        }
        return response()->json($post, 200);
    }

    public function onePosts(string $id)
    {
        $cacheKey = 'user.posts.' . $id;

        $posts = \Cache::remember($cacheKey, 60 * 10, function () use ($id) {

            $posts = Post::withCount(['likes', 'comments'])
                ->where('userId', $id)
                ->latest()
                ->get();

            if ($posts->isEmpty()) {
                throw new PostException('No posts found.', 404, null, false);
            }

            $posts = $posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'content' => $post->content,
                    'image' => asset('posts/' . $post->image),
                    'created_at' => $post->created_at,
                    'updated_at' => $post->updated_at,
                    'likes_count' => $post->likes_count,
                    'comments_count' => $post->comments_count,
                    'profilepicture' => asset('images/' . $post->user->profilepicture),
                    'name' => $post->user->name,
                    'bio' => $post->user->bio,
                    'post_count' => $post->user->posts()->count(),
                ];
            });

            return $posts;
        });

        return response()->json($posts, 200);
    }
}
