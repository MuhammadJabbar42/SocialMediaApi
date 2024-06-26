<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::middleware(['auth:sanctum', 'api'])
    ->prefix('v1')
    ->name('Notification.')
    ->group(function () {

        Route::get('/notification', [NotificationController::class, 'NotificationHistory']);
        Route::get('/notification/count', [NotificationController::class, 'CountUnreadNotification']);
        Route::get('/notification/seen', [NotificationController::class, 'SeenNotification']);
    });
