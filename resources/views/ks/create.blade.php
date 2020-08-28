
<h1>新闻发布</h1><br>
<button><a href="{{url('ks/index')}}">进入新闻列表</a></button>
<form>
@csrf
    新闻标题<input type="text" name="biaoti"><br>
    新闻内容<textarea name="desc" id="desc" cols="30" rows="10"></textarea><br>
    发布时间<input type="radio" name="time" id="times" value="1">立即发布
            <input type="radio" name="time" id="time" value="2">定时发布<span id="span"></span><br>
            <button id="ok">发布</button>
</form>
<script src="/static/jquery.js"></script>
<script>
    $(function(){
        $(document).on("click","#time",function(){
            var _this=$(this)
            _this.next().html("<input type='text' id='input'>");
            $("#input").blur(function(){
                $("#ok").click(function(){
                    var time=$("#input").val()
                    var desc=_this.prev().prev().prev().val()
                    var biaoti=_this.prev().prev().prev().prev().prev().val()
                    $.ajax({
                        url:"{{url('ks/store')}}",
                        data:{biaoti:biaoti,desc:desc,time:time},
                        type:"post",
                        success:function(res){
                            if(res=="ok"){
                                if(window.confirm("发布成功！")){
                                    location.href="/ks/index/";
                                }
                            }
                        }
				    });
                })
            })
        })
        $(document).on("click","#times",function(){
            var _this=$(this)
            $("#ok").click(function(){
                var desc=_this.prev().prev().val()
                var biaoti=_this.prev().prev().prev().prev().val()
                $.ajax({
                    url:"{{url('ks/stores')}}",
                    data:{biaoti:biaoti,desc:desc},
                    type:"post",
                    success:function(res){
                        if(res=="ok"){
                            if(window.confirm("发布成功！")){
                                location.href="/ks/index/";
                            }
                        }
                    }
		    });
        })
    })
    })
</script>