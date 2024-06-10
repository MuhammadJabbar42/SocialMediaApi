<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;



Route::middleware(['auth:sanctum'])
->prefix('v1')
->name('Like.')
->group(function () {

    Route::post('like/{id}',[LikeController::class,'like'])->name('Sending Like');
    Route::delete('like/{id}',[LikeController::class,'unlike'])->name('DesLike');
    
});