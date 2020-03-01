<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap 实列 - 水平表单</title>
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css">
    <script type="/static/js/jquery.min.js"></script>
    <script type="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>学生列表</h1></center><hr/> 
<form>
	<input type="text" name="name" value="{{$name}}" placeholder="请输入学生姓名">
	<input type="text" name="class" value="{{$class}}" placeholder="请输入学生班级">
	<input type="submit" value="搜索">
</form>
<table class="table">
	<caption>上下文表格布局</caption>
<thead>
	<tr>
		<th>ID</th>
		<th>学生姓名</th>
		<th>性别</th>
		<th>班级</th>
		<th>成绩</th>
		<th>操作</th>
	</tr>
</thead>
<thead>
	@foreach($data as $k=>$v)
	<tr @if($k%2==0) class='active' @else class='success' @endif>
		<td>{{$v->id}}</td>
		<td>{{$v->name}}</td>
		<td>{{$v->sex==1?'男':'女'}}</td>
		<td>{{$v->class}}</td>
		<td>{{$v->cj}}</td>
        <td>
        	<a href="{{url('student/edit/'.$v->id)}}" class='btn btn-info'>编辑</a>
            <a href="{{url('student/destroy/'.$v->id)}}" class='btn btn-danger'>删除</a>
        </td>
	</tr>
	@endforeach
	<tr><td colspan='7'>{{$data->appends(['name'=>$name,'class'=>$class])->links()}}</td></tr>
</thead>

</table>
</body>
</html>