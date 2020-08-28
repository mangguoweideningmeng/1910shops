<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redis;

class CheckLogin
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
        $_SERVER['id'] = 0;        //默认未登录
        $token= Cookie::get('token');
        // echo $enc_token;echo '</br>';
        // echo '<pre>';print_r($_SERVER);echo '</pre>';die;
        // die;
        //当前url地址
        $current_url=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        // echo '<pre>';print_r($current_uri);echo '</pre>';die;
        $_SERVER['current_url']=$current_url;
        if($token)
        {
            $url = env("PASSPORT_HOST") . '/web/check/token?token='.$token;

   // dd($url);
            // $res = file_get_contents("xhf.lyfn.top");
            
            $res = file_get_contents($url);

            $data = json_decode($res,true);
            
            if($data['errno']==0)       //token有效
            {
                $_SERVER['id'] = $data['data']['u']['id'];
                $_SERVER['name'] = $data['data']['u']['name'];
                $_SERVER['token'] = $token;
            }
        }


        return $next($request);
        
    }
}
