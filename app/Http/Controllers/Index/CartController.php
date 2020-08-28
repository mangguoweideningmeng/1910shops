<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\CartModel;
use App\Model\Goods;
use App\Model\Order;
use App\Model\Ordergoods;
use Illuminate\Support\Facades\Redis;
class CartController extends Controller
{
    public function cart(){
        $res=session('id');
        $where=[
            "id"=>$res
        ];
        $cart = CartModel::where($where)->get();
        return view('index.cart.cart',['cart'=>$cart]);
    }
    //重新获取小计
    public function toPrice(){
        $user_id=session('id');
        $goods_id=request()->goods_id;
        $goods_price=request()->goods_price;
        $buy_number=request()->buy_number;
        $where=[
            ['goods_id','=',$goods_id]
        ];
        $goodsInfo=Goods::where($where)->first();
        $goods_num=$goodsInfo['goods_num'];
        if($buy_number>=$goods_num){
            $buy_number=$goods_num;
        }else if($buy_number<1){
            $buy_number=1;
        }
        $wheres=[
            ['goods_id','=',$goods_id],
            ['id','=',$user_id]
        ];
        //
        $cart=CartModel::where($wheres)->update(['buy_number'=>$buy_number]);
        $money=$buy_number*$goods_price;
        echo $money;

    }
    public function cartDel(){
        //删除购物车表
        $goodsmodel=new CartModel();
        $id=session('id');
//        echo $id; die;
        $goods_id=request()->goods_id;
        $where=[
            'goods_id'=>$goods_id,
            'id'=>$id,
        ];
//        echo "111";die;
        $res=$goodsmodel::where($where)->delete();
        if($res){
             echo "ok";
        }else{
            echo  "no";
        }
    }
    //点击照片存redis
    public function gid(){
        $goods_id=request()->goods_id;
        Redis::hmset("hash",$goods_id,$goods_id);
        $aa=Redis::hgetall("hash");
        dd($aa);
    }
    //点击照片清除redis
    public function gids(){
        $goods_id=request()->goods_id;
        Redis::hdel("hash",$goods_id);
        $aa=Redis::hgetall("hash");
        dd($aa);
    }
    public function test(){
        $se=session('res');
        //dd($se);
    }
    //生成订单
    public function order(){
        $user_id=session("id");
        $goods_id=Redis::hgetall("hash");
        $cartInfo=CartModel::whereIn('goods_id',$goods_id)->get()->toArray();
        $order_no="jd".$cartInfo[0]['cart_id'].time();
        $amount=$cartInfo[0]['buy_number']*$cartInfo[0]['goods_price'];
        $data=[
            'order_no'=>$order_no,
            'order_amount'=>$amount,
            'order_time'=>time(),
            'id'=>$user_id
        ];
        $res=Order::insert($data);

        $where=[
            ['id','=',$user_id]
        ];
        $resss=Order::where($where)->get();

        $ress=CartModel::where($where)->get();

        $datas=[
            'goods_id'=>$ress[0]['goods_id'],
            'goods_name'=>$ress[0]['goods_name'],
            'goods_price'=>$ress[0]['goods_price'],
            'goods_img'=>$ress[0]['goods_img'],
            'buy_number'=>$ress[0]['buy_number'],
            'order_id'=>$resss[0]['order_id'],
            'id'=>$user_id
        ];
        Ordergoods::insert($datas);
        if($res){
            return redirect("index/orderindex");
        }else{
            return redirect("index/cart");
        }
    }
    //订单
    public function orderindex(){
        $goods_id=Redis::hgetall("hash");
        $res=Ordergoods::whereIn('goods_id',$goods_id)->get()->toArray();

        $money=0;
        foreach($res as $k=>$v){
            $money+=$v['goods_price']*$v['buy_number'];
        }

        return view("index.cart.order",['res'=>$res,'money'=>$money]);
    }

}
