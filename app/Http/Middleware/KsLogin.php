<?php

namespace App\Http\Middleware;

use Closure;

class KsLogin
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
        $user=session("userInfo");
        if(!$user){
            return redirect("ks/login");
        }
        return $next($request);
    }
}
