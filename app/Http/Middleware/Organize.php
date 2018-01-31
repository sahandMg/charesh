<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Organize
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
        $user = Auth::user()->organize;


        if(!count($user)>0 ){
            return redirect()->route('MakeOrganize');
        }

        if(Auth::user()->role == 'customer'){

            return redirect()->route('setting',['username',Auth::user()->username])->with(['settingError'=>'برای ساخت مسابقه، سطح دسترسی خود را به برگزارکننده تغییر دهید']);
        }
        return $next($request);
    }
}
