<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;

class beforeHome
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
//        dd($_SERVER['QUERY_STRING'] == null);
        if($_SERVER['QUERY_STRING'] == null){

           return redirect('chlbz/home');
        }

        return $next($request);
    }
}
