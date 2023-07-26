<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  $role
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Check if a role is required for the route, and
        // if so, ensure that the user has that role.
        if ($request->user()->hasRole($role) || !$role) {
            return $next($request);
        }
        return \App\Http\Controllers\API\ApiController::error('You are not authorized to access this resource.',401);
        // abort(403, 'This action is unauthorized.');
    }
}
