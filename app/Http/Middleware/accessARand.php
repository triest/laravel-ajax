<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class accessARand
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->aOrganizer == 1) {
            return $next($request);
        }
        return abort(404);
    }
}
