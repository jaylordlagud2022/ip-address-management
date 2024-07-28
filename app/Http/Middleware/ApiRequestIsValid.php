<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiRequestIsValid
{
    public function handle(Request $request, Closure $next, ...$methods)
    {
        // Ensure the user is authenticated using Passport
        if (Auth::guard('api')->guest()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
