<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\RoleException;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->hasRole('operator')) {
            abort('404');
            throw new RoleException("Error Processing Request", 404);
        }
        return $next($request);
    }
}
