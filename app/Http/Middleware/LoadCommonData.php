<?php

namespace App\Http\Middleware;

use Closure;

class LoadCommonData
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
        // when sharing data to all views here..
        // view()->share('')

    }
}
