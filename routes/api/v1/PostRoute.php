<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;



Route::middleware('auth:sanctum')
->prefix('v1')
->name('Post.')
->group(function () {

    Route::get('posts',[PostController::class,'show'])->name('ShowPosts'); //->withoutMiddleware('auth:sanctum');
    Route::get('post',[PostController::class,'onePostByUser'])->name('Show.One.Post.By.User');
    Route::get('post/{id}',[PostController::class,'onePost'])->name('Show.One.Post');
    Route::get('posts/{id}',[PostController::class,'onePosts'])->name('Show.Posts.By.Id');
    Route::post('post/create',[PostController::class,'makePost'])->name('Creating.Post');
    Route::put('post/update/{id}',[PostController::class,'updatePost'])->name('Updating.Post');
    Route::delete('post/delete/{id}',[PostController::class,'deletePost'])->name('Deleting.Post');

});
