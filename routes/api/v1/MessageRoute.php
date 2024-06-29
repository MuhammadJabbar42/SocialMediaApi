<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;


Route::middleware('auth:sanctum')
    ->prefix('v1')
    ->name('Message.')
    ->group(function () {

        Route::get('chat', [MessageController::class, 'getMessages'])->name('Show.Message');
        Route::post('chat', [MessageController::class, 'sendMessage'])->name('Send.Message');

    });
