<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BroadcastAuthController extends Controller
{
    public function authenticate(Request $request)
    {
        Log::info('Broadcast Auth Request', ['request' => $request->all(), 'user' => auth()->user()]);
        // Perform your auth logic here

        return response()->json(['message' => 'Authenticated'], 200);
    }    
}
