<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;

class AnyMiddleware
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
