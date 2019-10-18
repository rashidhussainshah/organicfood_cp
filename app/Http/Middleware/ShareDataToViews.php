<?php

namespace App\Http\Middleware;

use Closure;
use View;


class ShareDataToViews
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
        if (!$request->ajax())
        {
            View::share('head_categories', getMainMenu());

        }
        return $next($request);
    }
}
