<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EditorLoginMiddleware
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
        if(Auth::check())
        {
            $user = Auth::user();
            if(Auth::user()->permission == 2){
                return $next($request);
            }else{
                return redirect()->route('getLogin');
            }
        }
        else
            return redirect()->route('getLogin');
    }
}
