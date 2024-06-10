<?php

namespace App\Http\Controllers;

use App\Facades\CommentServiceFacade;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    public function comment(StoreCommentRequest $request,string $id)
    {
        return CommentServiceFacade::comment($request,$id);
    }
    public function deleteComment(string $id)
    {
        return CommentServiceFacade::deleteComment($id);
    }
    public function showCommentByPost(string $id)
    {
        return CommentServiceFacade::showCommentByPost($id);
    }
}
