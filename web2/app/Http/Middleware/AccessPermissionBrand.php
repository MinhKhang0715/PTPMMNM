<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;   
use Illuminate\Support\Facades\Route;


class AccessPermissionBrand
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
        
        if(Auth::user()->hasRole('brand')){
            return $next($request);
        }
        return redirect('/dashboard');
    }
}
