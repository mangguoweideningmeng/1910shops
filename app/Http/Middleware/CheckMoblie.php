<?php

namespace App\Http\Middleware;

use Closure;

class CheckMoblie
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
        // s
        $agent=$_SERVER['HTTP_USER_AGENT'];
        $mobile=[
            'iPad',
            'iPhone',
            'Android'
        ];
        foreach ($mobile as $k => $v) {
            if (strpos($agent,$v)) {
                return redirect('http://h5.1910.com/');
            }
        }
        return $next($request);
    }
}
