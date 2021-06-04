<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        if (auth()->user()->role->user_role_name == "admin") {
            return $next($request);
        }
        else if(auth()->user()->role->user_role_name == "student"){
            return redirect('student/home');
        }
        else if(auth()->user()->role->user_role_name == "lecturer"){
            return redirect('lecturer/home');
        }else{
        return response()->json('You are not allowed to access');
        }
    }
}
