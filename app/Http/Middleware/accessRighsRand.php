<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class accessRighsRand
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
        if (Auth::user() && Auth::user()->randOrganizer == 1) {
            return $next($request);
        }
        return abort(404);
    }
}
