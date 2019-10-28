<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Is_empleado
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
        if(Session::get('user_session')[1] == 2)
            return $next($request);
        return redirect('/');
    }
}
