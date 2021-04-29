<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForEditor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->user()->hasRole(['editor', 'admin'])) {
            return redirect('homepage');
        }

        return $next($request);
    }
}
