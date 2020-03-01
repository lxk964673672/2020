<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap 实列 - 水平表单</title>
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css">
    <script type="/static/js/jquery.min.js"></script>
    <script type="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>货物列表</h1></center><hr/>
<table class="table">
	<caption>上下文表格布局</caption>
	<form>
 
	
	<input type="submit" value="搜索">
</form>
<thead>
	<tr>
		<th>商品ID</th>
		<th>商品名称</th>
		<th>商品价格</th>
		<th>商品上架时间</th>
		<th>操作</th>
	</tr>
</thead>
<thead>
	@foreach($res as $k=>$v)
	<tr>
		<td>{{$v->id}}</td>
		<td>{{$v->name}}</td>
		<td>{{$v->price}}</td>
		<td>{{date('Y-m-d H:i:s',$v->time)}}</td>
        <td>无权限</td>
	</tr>
	@endforeach
</thead>
</table>
</body>
</html>