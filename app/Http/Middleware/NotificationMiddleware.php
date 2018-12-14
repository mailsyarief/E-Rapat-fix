<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use View;

class NotificationMiddleware
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
        if(Auth::user()) {
            $notifications = Auth::user()->notifications()->where('read_at', null)->orderBy('created_at','desc')->get();
            View::share('notifications', $notifications);
            return $next($request);
        }
        Auth::logout();
        return redirect('/login');
    }
}
