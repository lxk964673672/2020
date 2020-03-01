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
<center><h1>编辑页面</h1></center><hr/>

<form action="{{url('/goods/update'.$user->id)}}" method='post' class="form-horizontal" role="form" enctype='multipart/form-data'>
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='name' value="{{$user->name}}">
		</div>
	</div> 
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='hh' id="firstname" value="{{$user->hh}}">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='price' id="firstname" value="{{$user->price}}">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品缩略图</label>
		<div class="col-sm-10">
			<input type="file" name="img" class="form-control">
			<img src="{{env('UPLOAD_URL')}}{{$user->img}}"width='40px' height='40px'>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='kc' id="firstname" value="{{$user->kc}}">
		</div>
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio" name='jp' value='1' @if($user->jp==1) checked @endif>是
			<input type="radio" name='jp' value='2' @if($user->jp==2) checked @endif>否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否热卖</label>
		<div class="col-sm-10">
			<input type="radio" name='rm' value='1' @if($user->rm==1) checked @endif>是
			<input type="radio" name='rm' value='2' @if($user->rm==2) checked @endif'>否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否上架</label>
		<div class="col-sm-10">
			<input type="radio" name='sj' value='1' @if($user->sj==1) checked @endif>是
			<input type="radio" name='sj' value='2' @if($user->sj==2) checked @endif>否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品品牌</label>
		<div class="col-sm-10">
		       <select name="brand_id">
		       	 @foreach($brand as $v)
		       	<option value='{{$v->brand_id}}'>{{$v->brand_name}}</option>
		       	 @endforeach
		       </select>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-10">
			<select name="cate_id">
				<option value='0'>--请选择--</option>
				  @foreach($cate as $v)
				    <option value="{{$v->cate_id}}">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
			      @endforeach
			  </select>
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