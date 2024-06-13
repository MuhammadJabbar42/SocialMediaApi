<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpFoundation\Response;

class LocationFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if ($request->ip()) {
            $ip = '212.237.122.160';
            $location = Location::get($ip);
            if ($location->cityName == 'Erbil') {
                return $next($request);
            }
        }
        return response()->json(['message' => 'City Must Be Erbil in order To access this,sorry.'], 403);
    }
}
