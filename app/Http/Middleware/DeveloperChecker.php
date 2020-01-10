<?php

namespace App\Http\Middleware;

use Closure;
//use Auth;  ->  Auth::user()

class DeveloperChecker
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

        if( $request->user()->developer !== 1 ){
            return response('Not a developer here', 401);
        }

        return $next($request);
        
    }
}
