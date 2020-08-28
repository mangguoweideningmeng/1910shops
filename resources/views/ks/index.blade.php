<center>
<h1>新闻列表</h1><button><a href="{{url('ks/create')}}">去发布新闻</a></button><br>
<table border="1">
    <tr>
        <td>新闻id</td>
        <td>新闻标题</td>
        <td>发布时间</td>
        <td>发布人手机号或邮箱</td>
        <td>操作</td>
    </tr>
    @foreach($res as $k=>$v)
    <tr>
        <td>{{$v->xw_id}}</td>
        <td>{{$v->biaoti}}</td>
        <td>{{$v->time}}</td>
        <td>{{$v->name}}</td>
        <td></td>
    </tr>
    @endforeach
</table>
</center>