<?php

namespace App\Http\Middleware;

use Closure;

//TODO:後で削除
class Starter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  int                       $count
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $count = 0)
    {
        if (! \App\Starter::can($count)) {
            return redirect('/');
        }

        return $next($request);
    }
}
