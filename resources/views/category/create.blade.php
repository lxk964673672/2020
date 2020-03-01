<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>考试</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>文章添加</h1></center><hr/>
<form action="{{url('/category/store')}}" method="post">
		@csrf
	<table>
		<tr>
			<td style="text-align:right;">分类名称</td>
			<td><input type="text" name="cate_name">
                <b style="color:red">{{$errors->first('sname')}}</b>
			</td>
		</tr>
		<tr>
			<td style="text-align:right;">父级分类</td>
			<td>
				<select name='parent_id'>
					<option value='0'>--请选择--</option>
				  @foreach($cate as $v)
				    <option value="{{$v->cate_id}}">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
			      @endforeach
			    </select>
		    </td>
		</tr>
		<tr>
			<td style="text-align:right;">描述</td>
			<td><textarea name="desc"></textarea>
			</td>
		</tr>	
		<tr>
			<td colspan='2' style="text-align:center;"><input type="submit" value="添加"></td>
		</tr>
	</table>
</form>
</body>
</html>