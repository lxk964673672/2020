<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理员表</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center>
<div class="table-responsive">
  <form>
  <input type="text" name="admin" value="{{$admin}}"  placeholder="请输入用户名">
  <input type="submit" value="搜索">
  </form>
  <table class="table">
    <thead>
      <tr>
        <th>用户id</th>
        <th>用户名</th>
        <th>手机号</th>
        <th>邮箱</th>
        <td>操作</td>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $k=>$v)
      <tr>
        <td>{{$v->id}}</td>
        <td>{{$v->admin}}</td>
        <td>{{$v->tel}}</td>
        <td>{{$v->email}}</td>
        <td><a href="{{url('users/edit/'.$v->id)}}" class="btn btn-info">编辑</a> <a href="{{url('users/destroy/'.$v->id)}}" class="btn btn-danger">删除</a></td>
      </tr>
    @endforeach
      <tr>
            <td colspan="7">{{$data->appends(['admin'=>$admin])->links()}}</td>
      </tr>
    </tbody>
  </table>
</div>
</center>
</body>
</html>
