<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Shop;
class GoodsController extends Controller
{
    public function home(){
    	$data = Shop::select("goods_id","goods_name","goods_img","shop_price",)->orderBy("goods_id","desc")->limit(6)->get();
       	$response = [
            'errno' => 0,
            'msg'   => '成功',
            'data'  => [
                'list'  => $data
            ]
        ];
        return $response;
    }
    public function list(){
        $data = Shop::select("goods_id","goods_name","goods_img","shop_price",)->orderBy("goods_id","desc")->limit(60)->get();
        $response = [
            'errno' => 0,
            'msg'   => '成功',
            'data'  => [
                'list'  => $data
            ]
        ];
        return $response;
    }
}
