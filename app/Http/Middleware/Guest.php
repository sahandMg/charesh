<?php

namespace App\Http\Middleware;

use App\Url;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class Guest
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



            if (!Auth::check()) {
                if(isset($_SERVER['REQUEST_URI'])){
                    $record = new Url();
                    $record->token = csrf_token();
                    $record->pageUrl = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                    $record->ip = request()->ip();
                    $record->save();
                }
                return redirect()->route('login');

        }

        return $next($request);
    }
}
