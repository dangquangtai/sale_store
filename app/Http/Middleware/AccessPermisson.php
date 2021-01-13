<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Closure;



class AccessPermisson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user() != null) {
            if (Auth::user()->hasAnyRoles(['admin','author','user'])) {
                return $next($request);
            }
        }
        return redirect('/dashboard');
    }
}
