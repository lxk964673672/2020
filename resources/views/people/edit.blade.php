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
<center><h1>外来人口编辑</h1></center><hr/>
<form action="{{url('/people/update/'.$user->p_id)}}" method='post' class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">名字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='username' value='{{$user->username}}' id="firstname" 
				   placeholder="请输入名字">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">年龄</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='age' value='{{$user->age}}' id="firstname" 
				   placeholder="请输入年龄">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">身份证号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="card" value='{{$user->card}}' id="firstname" 
				   placeholder="请输入身份证号">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否湖北人&nbsp;&nbsp;</label>
		<div class="radio">
	 <lavel>
			<input type="radio" name="is_hubei"   value='1' @if($user->is_hubei==1) checked @endif>是
	 </lavel>
	 <label>
			<input type="radio" name="is_hubei"   value='2' @if($user->is_hubei==2) checked @endif>否
	 </label>
	</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">头像</label>
		<div class="col-sm-10">
			<input type="file" name="head" value="{{$user->head}}" class="form-control">
			<img src="{{env('UPLOAD_URL')}}{{$user->head}}" width='50px' height='50px'>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>
</body>
</html>