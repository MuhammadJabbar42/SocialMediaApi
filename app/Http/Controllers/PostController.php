<?php

namespace App\Http\Controllers;

use App\Facades\PostServiceFacade;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show()
    {
        return PostServiceFacade::show();
    }
    public function makePost(StorePostRequest $request)
    {
        return PostServiceFacade::makePost($request);
    }
    public function updatePost(UpdatePostRequest $request)
    {
        return PostServiceFacade::updatePost($request);
    }
    public function deletePost(Request $request)
    {
        return PostServiceFacade::deletePost($request);
    }
    public function onePostByUser()
    {
        return PostServiceFacade::onePostByUser();
    }
    public function onePost(string $id)
    {
        return PostServiceFacade::onePost($id);
    }   
     public function onePosts(string $id)
    {
        return PostServiceFacade::onePosts($id);
    }
}
