<?php

namespace App\Http\Middleware;

use Closure;
use \Session;

class Role
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
        if(auth()->check() && $request->user()->role == 0 && Session::get('admin_session') == NULL ){
            return redirect()->guest('/');
        }

        return $next($request);
    }
}
