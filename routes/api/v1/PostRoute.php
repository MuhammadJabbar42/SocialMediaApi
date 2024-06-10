<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;



Route::middleware('auth:sanctum')
->prefix('v1')
->name('Post.')
->group(function () {

    Route::get('posts',[PostController::class,'show'])->name('ShowPosts')->withoutMiddleware('auth:sanctum');
    Route::get('post',[PostController::class,'onePostByUser'])->name('ShowOnePostByUser');
    Route::get('post/{id}',[PostController::class,'onePost'])->name('ShowOnePost');
    Route::get('posts/{id}',[PostController::class,'onePosts'])->name('ShowOnePost');
    Route::post('post/create',[PostController::class,'makePost'])->name('CreatingPost');
    Route::put('post/update/{id}',[PostController::class,'updatePost'])->name('UpdatingPost');
    Route::delete('post/delete/{id}',[PostController::class,'deletePost'])->name('DeletingPost');
    
});