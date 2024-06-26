<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Facades\Location;

Route::get('/ip', function (Request $request) {

    $ip = '212.237.122.160';
    $location = Location::get($ip);
    return response()->json($location, 200);

})->middleware('Location');


Route::get('/test', function () {
    //Cache::put('name', 'hama', 180);
    $user = \App\Models\User::find(1);

    if(Cache::has('age' ))
    {
        return response()->json(Cache::get('age'),200);

    }
    else
    {
        Cache::put('age',$user->name,20);
        return "No caching";
    }
//    return Cache::get('name');
});
