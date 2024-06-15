<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationEmail;


Route::middleware(['auth:sanctum', 'api'])
    ->prefix('v1')
    ->name('Email.')
    ->group(function () {

        Route::get('verify', [VerificationEmail::class, 'verify'])->name('Verify.For.Test');

        Route::post('resend', [VerificationEmail::class, 'resend'])->name('resend');
        Route::post('resend/{id}', [VerificationEmail::class, 'resendId'])->name('resendById')->withoutMiddleware('auth:sanctum');
        Route::post('email/verify', [VerificationEmail::class, 'checkCode'])->name('EmailVerification');

        Route::get('email/test/{id}', [VerificationEmail::class, 'test'])->name('test')->withoutMiddleware('auth:sanctum');
        Route::get('verify/{token}', [VerificationEmail::class, 'verifyEmail'])->name('EmailVerificationById')->withoutMiddleware('auth:sanctum');
    });
