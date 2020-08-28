<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\Myorder;
use App\Model\UserModel;
use App\Model\Pinglun;
use App\Model\Shoucang;
use App\Model\Ordergoods;
use Illuminate\Support\Facades\Redis;
use DB;
class MyorderController extends Controller
{
//    我的订单
    public function order(){

    }

    //我的评论
    public function desc(){
        $user_id=session("id");

        $where=[
            ['pinglun.id',"=",$user_id]
        ];
        $data=Pinglun::where($where)
            ->leftJoin('users','pinglun.id','=','users.id')
            ->leftJoin('goods','pinglun.goods_id','=','goods.goods_id')
            ->get();
        return view("index.order.desc",["data"=>$data]);

    }

    //我的收藏
    public function collect(){

        $user_id=session("id");
        $where=[
            "shoucang.id"=>$user_id,
            "is_shoucang"=>1
        ];
        $goods=Shoucang::where($where)->leftJoin('users','shoucang.id','=','users.id')->get();
        return view("index.order.collect",["goods"=>$goods]);
    }
    public function quit(){
        session(['user'=>null]);
        return redirect('/');
    }

    public function pay()
    {
        $user_id=session("id");
        $where=[
            ['id','=',$user_id],
            ['pay_status','=',1]
        ];
        $ordergoods=Order::where($where)->first();
        $param = [
            'out_trade_no'=> $ordergoods['order_no'],
            'product_code'=> 'FAST_INSTANT_TRADE_PAY',
            'total_amount'=> $ordergoods['order_amount'],
            'subject'=> '商品支付',
        ];
        $pubParam = [
            'app_id'=> 2016101700707309,
            'method'=> 'alipay.trade.page.pay',
            'return_url'=> 'http://x.liliqin.xyz',   //同步通知地址
            'charset'=> 'utf-8',
            'sign_type'=> 'RSA2',
            'timestamp'=> date('Y-m-d H:i:s'),
            'version'=> '1.0',
            'notify_url'=> 'http://x.liliqin.xyz',   // 异步通知
            'biz_content'=> json_encode($param),
        ];

        ksort($pubParam);
        $str = "";
        foreach($pubParam as $k=>$v)
        {
            $str .= $k . '=' . $v . '&';
        }
        $str=rtrim($str,'&');
        $sign=$this->sign($str);

        $url = 'https://openapi.alipaydev.com/gateway.do?'.$str.'&sign='.urlencode($sign);
        return redirect($url);
        header('Location:'.$request_url);
    }

    protected function sign($data)
    {
        $priKey = file_get_contents(storage_path('keys/priv_myali.key'));
        $res = openssl_get_privatekey($priKey);
        ($res) or die('私钥有误');
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        openssl_free_key($res);
        $sign = base64_encode($sign);
        return $sign;
    }

    public function returnurl()
    {
        $sign=base64_decode($_GET['sign']);
        $data=$_GET;
        unset($data['sign']);
        unset($data['sign_type']);
        ksort($data);
        $str='';
        foreach($data as $k=>$v){
            $str.=$k.'='.$v.'&';
        }
        $str=rtrim($str,'&');
        $key=file_get_contents(storage_path('keys/pub_ali.key'));
        $key=openssl_get_publickey($key);
        $res=openssl_verify($str,$sign,$key, OPENSSL_ALGO_SHA256);
        // dd($res);
        return redirect('/');
    }
}
