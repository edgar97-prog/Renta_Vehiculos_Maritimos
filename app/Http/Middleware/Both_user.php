<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Both_user
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
        if(Session::get('user_session')[1] == 2 || Session::get('user_session')[1] == 3)
            return $next($request);
        return redirect('/');
    }
}
