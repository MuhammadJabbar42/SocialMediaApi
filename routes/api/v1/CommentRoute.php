<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;


Route::middleware('auth:sanctum')
->prefix('v1')
->name('Comment.')
->group(function () {
    Route::post('comment/{id}',[CommentController::class,'comment'])->name('Commenting');
    Route::delete('comment/{id}',[CommentController::class,'deleteComment'])->name('Delete Comment');
    Route::get('comment/{id}',[CommentController::class,'showCommentByPost'])->name('Show Comment');
});