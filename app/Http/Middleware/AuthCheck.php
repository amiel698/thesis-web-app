<?php

namespace App\Http\Middleware;

use Closure;

class AuthCheck
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
         if(!session()->has('LoggedUser') && ($request->path() != 'login' && $request->path() != 'register')){
            return redirect('login')->with('fail', 'You must be logged in');
        }

        if(session()->has('LoggedUser') && ($request->path() == 'login' || $request->path() == 'register')){
            return back();
        }
        return $next($request);
    }
}
