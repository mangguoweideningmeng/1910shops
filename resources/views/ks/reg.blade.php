
<h1>注册页面</h1><br>
<button><a href="{{url('ks/login')}}">进入登录页面</a></button>

<form action="{{url('ks/regDo')}}" method="post">
@csrf
    请输入邮箱或手机号<input type="text" name="name">{{$errors->first("name")}}{{session('tel')}}{{session('email')}}<br>
    请输入密码<input type="text" name="pwd">{{$errors->first("pwd")}}{{session('msg')}}{{session('msgs')}}<br>
    <input type="submit" value="点击注册">
</form>
