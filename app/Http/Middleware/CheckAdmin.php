<?php

namespace App\Http\Middleware;
use Gate;

use Closure;

class CheckAdmin
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
        abort_if(Gate::denies('check-admin'), 403, 'Permission denies');

        return $next($request);
    }
}
