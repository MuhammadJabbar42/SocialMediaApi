<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {

    return Cache::remember('welcome-view', 60*60*24, function () {
        return view('welcome')->render();
    });
});


Route::get('/api-demo', function () {
    return Cache::remember('api-demo', 60*60*24, function () {
        return view('api-demo')->render();
    });
})->name('api-demo');

