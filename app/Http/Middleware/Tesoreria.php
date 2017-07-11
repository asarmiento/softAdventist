<?php

namespace App\Http\Middleware;

use Closure;

class Tesoreria
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
        if (currentUser()->type_user =='cont') {
            return redirect('/tesoreria/home');
        }
        return $next($request);
    }
}
