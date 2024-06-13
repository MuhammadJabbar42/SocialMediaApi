<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Facades\Location;

Route::get('/ip',function (Request $request){

    $ip = '212.237.122.160';
    $location = Location::get($ip);
    return response()->json($location,200);

})->middleware('Location');