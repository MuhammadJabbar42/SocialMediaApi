<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowController;



Route::middleware('auth:sanctum')
->prefix('v1')
->name('Like.')
->group(function () {

    Route::post('follow/{id}',[FollowController::class,'follow'])->name('Sending Follow');
    Route::delete('unfollow/{id}',[FollowController::class,'unfollow'])->name('UnFollow');
    Route::get('followers',[FollowController::class,'followers'])->name('Follower');
    Route::get('followings',[FollowController::class,'following'])->name('Followings');
    
});