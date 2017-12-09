<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Confirm
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

        if(Auth::check()){

            if(Auth::user()->confirm == 0){


                Auth::logout();
                return redirect()->route('verify')->with(['message'=>'لطفا حساب کاربری خود را فعال کنید']);

            }

        }

        return $next($request);
    }
}
