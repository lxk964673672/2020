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
<h3>添加管理员</h3></hr>
<!-- @if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->
<form class="form-horizontal" role="form" action="{{url('/users/store')}}" method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="admin">
            <b style="color:blue">{{$errors->first('admin')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-2">
            <input type="password" class="form-control" id="firstname" name="pwd" >
            <b style="color:black">{{$errors->first('pwd')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-2">
            <input type="password" class="form-control" id="firstname" >
            
        </div>
    </div>
    
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">电话</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="tel">
            <b style="color:blue">{{$errors->first('tel')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="email">
            <b style="color:blue">{{$errors->first('email')}}</b>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">添加</button>
        </div>
    </div>
</form>

</body>
</html>