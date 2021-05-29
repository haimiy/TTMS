<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Lecturer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role->user_role_name) {
            return $next($request);
        }
        return response()->json('You are not allowed to access');
    }
}
