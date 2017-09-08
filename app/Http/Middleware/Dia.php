<?php

namespace App\Http\Middleware;

use Closure;

class Dia
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
        if (currentUser()->type_user == 'dia') {
            return $next($request);
        }
        return redirect('/home');
    }
}
