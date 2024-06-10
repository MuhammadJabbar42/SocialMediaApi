<?php

use App\Http\Controllers\BroadcastAuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//**User Routes**/

Route::middleware(['auth:sanctum','api','sessionStart'])
->prefix('v1')
->name('User.')
->group(function () {

    Route::post('signup',[UserController::class,'signup'])->withoutMiddleware(['auth:sanctum','sessionStart'])->name('SignUp');
    Route::post('login',[UserController::class,'login'])->withoutMiddleware('auth:sanctum')->name('Login');
    Route::get('logout',[UserController::class,'logout'])->name('logout');
    Route::post('tki',[UserController::class,'checkTokens'])->withoutMiddleware('auth:sanctum')->name('CheckTokens');
    Route::get('user',[UserController::class,'userDetail'])->name('ShowUser');
    Route::post('user/update',[UserController::class,'updateProfile'])->name('UpdateProfile');

});



//**EmailVerification Routes**/

Route::middleware(['auth:sanctum','api'])
->prefix('v1')
->name('Email.')
->group(function () {

    Route::get('verify',[VerificationEmail::class,'verify'])->name('Verify.For.Test');

    Route::post('resend',[VerificationEmail::class,'resend'])->name('resend');
    Route::post('resend/{id}',[VerificationEmail::class,'resendId'])->name('resendById')->withoutMiddleware('auth:sanctum');
    Route::post('email/verify',[VerificationEmail::class,'checkCode'])->name('EmailVerification');

    Route::get('email/test/{id}',[VerificationEmail::class,'test'])->name('test')->withoutMiddleware('auth:sanctum');
    Route::get('verify/{token}',[VerificationEmail::class,'verifyEmail'])->name('EmailVerificationById')->withoutMiddleware('auth:sanctum');
});
 
//**Post Routes**/

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

//**Like Routes**/

Route::middleware(['auth:sanctum'])
->prefix('v1')
->name('Like.')
->group(function () {

    Route::post('like/{id}',[LikeController::class,'like'])->name('Sending Like');
    Route::delete('like/{id}',[LikeController::class,'unlike'])->name('DesLike');
    
});



//**Follow Routes**/

Route::middleware('auth:sanctum')
->prefix('v1')
->name('Like.')
->group(function () {

    Route::post('follow/{id}',[FollowController::class,'follow'])->name('Sending Follow');
    Route::delete('unfollow/{id}',[FollowController::class,'unfollow'])->name('UnFollow');
    Route::get('followers',[FollowController::class,'followers'])->name('Follower');
    Route::get('followings',[FollowController::class,'following'])->name('Followings');
    
});


//**Comment Routes**/

Route::middleware('auth:sanctum')
->prefix('v1')
->name('Comment.')
->group(function () {
    Route::post('comment/{id}',[CommentController::class,'comment'])->name('Commenting');
    Route::delete('comment/{id}',[CommentController::class,'deleteComment'])->name('Delete Comment');
    Route::get('comment/{id}',[CommentController::class,'showCommentByPost'])->name('Show Comment');
});

//**Message Routes**/

Route::middleware('auth:sanctum')
->prefix('v1')
->name('Message.')
->group(function () {

    Route::get('chat',[MessageController::class,'getMessages']);
    Route::post('chat',[MessageController::class,'sendMessage']);

});


// Route::middleware('auth:sanctum')
// ->prefix('v1')
// ->name('Broadcasting.')
// ->group(function () {

//     Route::post('/broadcasting/auth', [BroadcastAuthController::class, 'authenticate']);

// });

