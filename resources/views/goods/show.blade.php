<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap 实列 - 水平表单</title>
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css">
    <script type="/static/js/jquery.min.js"></script>
    <script type="/static/js/bootstrap.min.js"></script>
</head>
<body>
 
<h1>{{$goods->name}}</h1><hr/>
<p>当前访问量:{{$goods->count}}</p>
<p>商品价格:{{$goods->price}}</p>
<p>视频库存:{{$goods->kc}}</p>
</body>
</html>