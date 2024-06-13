<?php

namespace App\Services;

use App\Exceptions\PostException;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostService
{

    public function show()
    {
        $posts = Post::withCount(['likes', 'comments'])
            ->latest()
            ->get();
        if ($posts->count() <= 0) {
            throw new PostException('No Post Made it yet.', 404);
        }
        $posts = $posts->map(function ($post) {
            $post->user->profilepicture = asset('images/' . $post->user->profilepicture);
            $post->image = asset('posts/' . $post->image);
            $users = User::with(['followers', 'following'])->find($post->userId);
            $post->user->followers_count = $users->followers()->count();
            $post->user->following_count = $users->following()->count();
            $post->user->post_count = $users->posts()->count();
            return $post;
        });
        return response()->json($posts, 200);
    }

    public function makePost(Request $request)
    {
        $user = auth()->user();
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
        $post = Post::where('userId', $user->id)->where('id', $request->id)->first();
        $post->delete();
        if (!$post) {
            throw new PostException('Failed to deleting The post, Please try again', 500);
        }
        return response()->json(['Message' => 'Post Has Been Deleted Successfully!'], 200);
    }
    public function onePostByUser()
    {
        $user = auth()->user();
        $posts = Post::withCount(['likes', 'comments'])->where('userId', $user->id)
            ->latest()
            ->get();
        if($posts->count() <=0)
        {
            throw new PostException('You donnt have any posts.',404);
        }
        $posts = $posts->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
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
        return response()->json($posts, 200);
    }
    public function onePost(string $id)
    {
        $post = Post::where('id', $id)->first();
        if (!$post) {
            throw new PostException('Post Not Found!', 404);
        }
        return response()->json($post, 200);
    }
    public function onePosts(string $id)
    {
        $posts = Post::withCount(['likes', 'comments'])->where('userId', $id)
            ->latest()
            ->get();
        if(!$posts->count() <=0 )
        {
            throw new PostException('No Post Found.',404);
        }
        $posts = $posts->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
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
        return response()->json($posts, 200);
    }
}
