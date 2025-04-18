<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if(Auth::user()->role_id == "1" || Auth::user()->role_id == "2"){
                return $next($request);       
            }else{
                return redirect('login')->with('message', 'Login as a normal user');
            }
        }else{
            return redirect('adminLogin')->with('message','Please login First');
        }
    }
}
