<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Master
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
        if (auth()->user()->role->lecturer_role_name == "master") {
            return $next($request);
        }
    }
}
