<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class DjAuth
{
    // /**
    //  * Handle an incoming request.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \Closure  $next
    //  * @return mixed
    //  */
    // public function handle($request, Closure $next)
    // {
    //     if(Auth::check()){
    //         return $next($request);
    //     }
    //     return redirect('customer/login');
    // }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    // protected function redirectTo($request)      // uncomment -->1
    // {
        
    //     if (! $request->expectsJson()) {
    //         return route('dj.login');
    //     }
    // }

    public function handle($request, Closure $next)
    {
        if(Auth::guard()->check()){
            return $next($request);
        }
        
        return redirect('dj/login');
    }

    // protected function authenticate($request, array $guards)     // uncomment -->2
    // {
    //     if($this->auth->guard('dj')->check())
    //     {
    //         return $this->auth->shouldUse('dj');
    //     }
      

    //     $this->unauthenticated($request,['dj']);
    // }

}
