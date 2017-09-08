<?php

namespace App\Http\Middleware;

use Closure;

class Union
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
        if (currentUser()->type_user == 'union') {
            return $next($request);
        }
        return redirect('/home');
    }
}
