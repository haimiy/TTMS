<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CoordinatorMiddleware
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
        
        if (auth()->user()->role->user_role_name == "lecturer") {
            if (auth()->user()->lecturer->lecturer_role->lecturer_role_name != "coordinator") {
                return redirect('lecturer/home');
            }
            return $next($request);
        }
        else if(auth()->user()->role->user_role_name == "admin"){
            return redirect('admin/home');
        }
        else if(auth()->user()->role->user_role_name == "student"){
            return redirect('student/home');
        }else{
        return response()->json('You are not allowed to access');
        }
    }
}
