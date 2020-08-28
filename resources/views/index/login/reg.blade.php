
@extends("layout.bottom")
@extends("layout.navright")
@extends("layout.shop")

@section("title","注册")
@section('content')







<!-- register -->
<div class="pages section">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="pages-head">
            <h3>REGISTER</h3>
        </div>
        <div class="register">
            <div class="row">
                <form class="col s12">
                    <div class="input-field">
                        <input type="text" class="validate" placeholder="NAME" required id="name">
                    </div>
                    <div class="input-field">
                        <input type="text" name='tel' placeholder="请输入手机号" class="validate" id="tel" required>

                        <input type="button" value="发送验证码" id='a'>
                        <input type="text" name="code" placeholder="请输入验证码" id="code">
                    </div>
                    <div class="input-field">
                        <input type="email" placeholder="EMAIL" class="validate" required id="email">
                    </div>
                    <div class="input-field">
                        <input type="password" placeholder="PASSWORD" class="validate" required id="password">
                    </div>
                    <div class="btn button-default" id="register">REGISTER</div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end register -->


<!-- loader -->
<div id="fakeLoader"></div>
<!-- end loader -->


<div class="footer">
    <div class="container">
        <div class="about-us-foot">
            <h6>Mstore</h6>
            <p>is a lorem ipsum dolor sit amet, consectetur adipisicing elit consectetur adipisicing elit.</p>
        </div>
        <div class="social-media">
            <a href=""><i class="fa fa-facebook"></i></a>
            <a href=""><i class="fa fa-twitter"></i></a>
            <a href=""><i class="fa fa-google"></i></a>
            <a href=""><i class="fa fa-linkedin"></i></a>
            <a href=""><i class="fa fa-instagram"></i></a>
        </div>
        <div class="copyright">
            <span>© 2017 All Right Reserved</span>
        </div>
    </div>
</div>

@endsection
<script src="/static/jquery.js"></script>
<script>

    $(document).on('click','#a',function(){
        var name=$('input[name="tel"]').val();
        var mobilereg=/^1[3|5|6|7|8|9]\d{9}$/;
        // alert(mobilereg.test(name));
        if(mobilereg.test(name)){
            //发送手机验证码
            $.get("/reg/sendSMS",{name:name},function(result){
                // alert(result)
                if (result.code=='00001') {
                    alert(result.msg);
                }
                if (result.code=='00000') {
                    alert(result.msg);
                }

            },'json');
            return;
        }
        alert("请输入正确的手机号");
    })
    $(document).on("click","#register",function () {
        var _this=$(this);
        var name=$("#name").val();
        var password=$("#password").val();
        var email=$("#email").val();
        var tel=$('#tel').val();
        var code=$('#code').val();
        
        if (!code) {
            alert("验证码不能为空");
            return false;
        };
          //alert(password);
        //验证名称由中文组成
        var pattern = /^[\u4E00-\u9FA5]{1,6}$/;
        if(!pattern.test(name)) {
            alert("用户名由中文组成 ,并且长度1-6位");
            return false;
        }

        //验证密码长度
        var pwd_test=/^[a-zA-Z0-9]{6,15}$/;
        if(!pwd_test.test(password)){
            alert("密码长度由6-15位 数字 大写字母 小写字母组成，不能有特殊符号");
            return false;
        }

        //验证邮箱格式
        var email_test= /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
        if (!email_test.test(email) ){
            alert("请输入正确的邮箱格式123");
            return false;
        }

        //ajax把数据传到后台
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        $.ajax({
           url:"{{url("/index/reg_do")}}",
            type:"POST",
            data:{name:name,email:email,password:password,tel:tel,code:code},
            success:function(res) {

                if(res.err_code=="000"){
                    alert("注册成功");
                    window.location.href="{{url('/index/login')}}";
                }else{
                    alert("注册失败");
                    return false;
                }
            }
        });

    });
</script>
