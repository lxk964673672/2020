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
<center><h1>学生编辑</h1></center><hr/>
<form action="{{url('/student/update/'.$user->id)}}" method='post' class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生姓名</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='name' value='{{$user->name}}' id="firstname" 
				   placeholder="请输入学生姓名">
				    <b style='color:red'>{{$errors->first('name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">性别&nbsp;&nbsp;</label>
		<div class="radio">
	 <lavel>
			<input type="radio" name="sex"   value='1' @if($user->sex==1) checked @endif>男
	 </lavel>
	 <label>
			<input type="radio" name="sex"   value='2' @if($user->sex==2) checked @endif>女
	 </label>
	</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">班级</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='class' value='{{$user->class}}' id="firstname" 
				   placeholder="请输入班级">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">成绩</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="cj" value='{{$user->cj}}' id="firstname" 
				   placeholder="请输入成绩">
				    <b style='color:red'>{{$errors->first('cj')}}</b>
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