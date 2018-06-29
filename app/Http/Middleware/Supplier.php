<?php

namespace App\Http\Middleware;

use App\Tournament;
use Closure;
use Illuminate\Support\Facades\Auth;

class Supplier
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

        if(Auth::check() && Auth::user()->role == 'supplier'){

            if(!isset(Auth::user()->organize)){
                return redirect()->route('setting',['username'=>Auth::user()->slug])->with(['settingError'=>'برای ثبت نام در مسابقه، سطح دسترسی خود را به شرکت کننده تغییر دهید']);
            }
            return redirect()->route('orgEdit',['orgName'=>Auth::user()->organize->slug])->with(['settingError'=>'برای ثبت نام در مسابقه، سطح دسترسی خود را به شرکت کننده تغییر دهید']);

        }


        if(Tournament::where([['slug',$request->matchName],['id',$request->id]])->first() == null ){

            abort('404');
        }

        return $next($request);
    }
}
