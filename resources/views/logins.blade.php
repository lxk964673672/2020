<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>登陆页面</h1></center><hr/>
<form action="{{url('/logins/loginsdo')}}" method='post' class="form-horizontal" role="form" enctype='multipart/form-data'>
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户名</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='uname' id="firstname" 
				   placeholder="请输入用户名">
				 
		</div>
	</div> 
 
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" name='upwd' id="firstname" 
				   placeholder="请输入密码">
				   
		</div>
	</div>
		<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">权限</label>
		<div class="col-sm-10">
			<input type="radio" class="form-control" name='qx' value='1' id="firstname" checked>普通库管员
			<input type="radio" class="form-control" name='qx' value='2' id="firstname">库管主管
				   
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">登录</button>
		</div>
	</div>
</form>

</body>
</html>