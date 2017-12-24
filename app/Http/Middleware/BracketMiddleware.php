<?php

namespace App\Http\Middleware;

use App\Tournament;
use Closure;

class BracketMiddleware
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


       if(Tournament::where('id',$request->id)->first()->endTime == 0){

           return $next($request);


       }else{

           return redirect()->route('challengePanel',['id'=>$request->id,'matchName'=>$request->matchName])->with(['bracketError'=>' ساخت براکت تنها بعد از اتمام زمان ثبت نام ممکن است   ']);
       }


    }
}
