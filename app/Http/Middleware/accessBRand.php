<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class accessBRand
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
        if (Auth::user() && Auth::user()->bOrganizer == 1) {
            return $next($request);
        }
        return abort(404);
    }
}
