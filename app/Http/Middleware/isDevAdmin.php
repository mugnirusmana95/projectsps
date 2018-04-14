<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isDevAdmin
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
        if (Auth::user()->level == 0 || Auth::user()->level == 1) {
            return $next($request);
         } else {
           abort(403);
         }

    }
}
