<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//首页商品
Route::get('/goods/index','Api\GoodsController@home');
//商品列表
Route::get('/goods/list','Api\GoodsController@list');
Route::get('/xxx',function(){
    echo 2222;
});