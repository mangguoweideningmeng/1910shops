<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
class LoginController extends Controller
{
    //登录
    public function login(){
        return view('index.login.login');
    }
    public function login_do(){
        $data=request()->except('_token');
        $name=$data['name'];
        $password=$data['password'];

        //var_dump($password);die;
        $userInfo=UserModel::where('name',$name)->first();
        if(!$userInfo){
            return ["err_code" => 005, "msg" => "账号密码错误，请重新输入"];
        }
        if($userInfo){
            if($userInfo['password']!=$password){
                return ["err_code" => 005, "msg" => "账号密码错误，请重新输入"];
            }
        }
        $se=session(["id"=>$userInfo['id']]);
        session(['user'=>$userInfo]);
         return ["err_code" => 006, "msg" => "登录成功"];
    }


    //注册
    public function reg(){
        return view('index.login.reg');
    }
    public function reg_do(){
        $data=request()->except('_token');
        $info=session('info');
        $code=$info['code'];
        $tel=$data['tel'];

        //var_dump($password);die;
        //验证手机号
        if(empty($data['code'])){
              return ["err_code" => 005, "msg" => "验证码不能为空"];
        }
        if ($data['code']!=$code){

              return ["err_code" => 005, "msg" => "验证码有误"];
        }

        if ($tel!=$info['tel']){

            return ["err_code" => 005, "msg" => "发送验证码手机号与当前手机号不符"];
        }
        if ((time()-$info['addtime'])>300){

            return ["err_code" => 005, "msg" => "验证码已失效，请重新获取"];
        }
        $reg='/^1[3578]\d{9}$/';
        $pwd_reg="/^\w{6,16}$/";
        if(preg_match($reg,$data['tel'])<1){
             return ["err_code" => 005, "msg" => "手机号有误"];
        }
        //验证用户名
        if (!preg_match("/^[\u4E00-\u9FA5]{1,6}$/", $data['name']) == false ) {
            return ["err_code" => 001, "msg" => "用户名由中文组成,长度1-6位"];
        }
        if($data['name']==""){
            return ["err_code" => 001, "msg" => "用户名由中文组成,长度1-6位"];
        }
        $res=UserModel::where('name',$data['name'])->first();
        if($res){
            return ["err_code" => 002, "msg" => "该用户名已存在"];
        }

        //验证密码
       if($data['password']==""){
           return ["err_code" => 003, "msg" => "密码长度由6-15位 数字 大写字母 小写字母组成，不能有特殊符号"];
       }
       $p='/^[a-zA-Z0-9]{6,15}$/';
       if(!preg_match($p,$data['password'])){
           return ["err_code" => 003, "msg" => "密码长度由6-15位 数字 大写字母 小写字母组成，不能有特殊符号"];
       }


        //验证用户邮箱
        if (!preg_match("/^[a-zA-Z0-9]{6,}@[a-zA-Z0-9]{3,}\.[0-9a-zA-Z]{3,}$/",$data['email'])==false){
            return ["err_code" => 004, "msg" => "请输入正确的邮箱格式"];
        }
        if($data['email']==""){
            return ["err_code" => 004, "msg" => "请输入正确的邮箱格式"];
        }

        //添加入库
        $register_data=[
            "name"=>$data['name'],
            "password"=>$data['password'],
            "email"=>$data['email'],
            "created_at"=>time(),
            "tel"=>$tel
        ];
        $register=UserModel::insert($register_data);
        if($register_data){
            return ["err_code" => 000, "msg" => "注册成功"];
        }

    }
    public function test(){
        $se=session('id');
        dd($se);
    }
    //退出
    public function quit(){
        session(['user'=>null]);
        return redirect('/');
//        echo 111;
    }


    public function sendSMS(){
        $name=request()->name;
        $reg='/^1[3|5|6|7|8|9]\d{9}$/';
        if(!preg_match($reg,$name)){
            return json_encode(['code'=>'00001','msg'=>'请输入正确的手机号']);
        }
        $code=rand(100000,999999);
        $result=$this->send($name,$code);
        //发送成功
        if ($result['Message']=='OK'){
            $info=[
                'tel'=>$name,
                'addtime'=>time(),
                'code'=>$code
            ];
            session(['info'=>$info]);
            return json_encode(['code'=>'00001','msg'=>'发送成功']);
        }
        //发送失败
        return json_encode(['code'=>'00000','msg'=>$result['Message']]);
    }
    public function send($name,$code){



// Download：https://github.com/aliyun/openapi-sdk-php
// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

        AlibabaCloud::accessKeyClient('LTAI4Foy8CWaHNSt5sJSxgCs','5Ss8HSWr803EKV11VpQxYHOr79h4Hq')
            ->regionId('cn-hangzhou')
            ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => "cn-hangzhou",
                        'PhoneNumbers' => $name,
                        'SignName' => "猪猪男孩的爱",
                        'TemplateCode' => "SMS_183266645",
                        'TemplateParam' => "{code:$code}",
                    ],
                ])
                ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            return  $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        }


    }


    public function githubLogin()
    {
        $url = 'https://github.com/login/oauth/authorize?client_id='.env('ClIENT_ID').'&redirect_uri='.env('CITENT_SCSR').'/oauth/github';
        return redirect($url);
    }




}
