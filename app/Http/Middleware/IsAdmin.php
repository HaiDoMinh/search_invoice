<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use \Auth;

class IsAdmin
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
        if( empty( Auth::user() ) )
        {
            Auth::logout();
            return redirect('/login');
        }

        if( Auth::user() ){
            return $next($request);
        }

    }
}
