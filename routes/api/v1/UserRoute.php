<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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