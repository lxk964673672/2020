<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap 实列 - 水平表单</title>
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css">
    <script type="/static/js/jquery.min.js"></script>
    <script type="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>外来人口列表</h1></center><hr/>
<form>
	<input type="text" name="username" value="{{$username}}" placeholder="请输入用户名">
	<input type="submit" value="搜索">
</form>
<table class="table">
	<caption>上下文表格布局</caption>
<thead>
	<tr>
		<th>ID</th>
		<th>用户名</th>
		<th>年龄</th>
		<th>身份证号</th>
		<th>头像</th>
		<th>是否湖北人</th>
		<th>添加时间</th>
		<th>操作</th>
	</tr>
</thead>
<thead>
	@foreach($data as $k=>$v)
	<tr @if($k%2==0) class='active' @else class='success' @endif>
		<td>{{$v->p_id}}</td>
		<td>{{$v->username}}</td>
		<td>{{$v->age}}</td>
		<td>{{$v->card}}</td>
		<td>@if($v->head)<img src="{{env('UPLOAD_URL')}}{{$v->head}}"width='40px' height='40px'>@endif</td>
		<td>{{$v->is_hubei==1?'是':'否'}}</td>
		<td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
        <td>
        	<a href="{{url('people/edit/'.$v->p_id)}}" class='btn btn-info'>编辑</a>
            <a href="{{url('people/destroy/'.$v->p_id)}}" class='btn btn-danger'>删除</a>
        </td>
	</tr>
	@endforeach
	<tr><td colspan='7'>{{$data->appends(['username'=>$username])->links()}}</td></tr>
</thead>

</table>
</body>
</html>