<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});


Route::get('/api-demo',function (){
    return view('api-demo');
})->name('api-demo');

