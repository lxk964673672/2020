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
<center><h1>添加商品</h1></center><hr/>
@if($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
	</ul>
</div>
@endif
<form action="{{url('/goods/store')}}" method='post' class="form-horizontal" role="form" enctype='multipart/form-data'>
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='name' id="firstname" 
				   placeholder="请输入名字">
				<b style='color:red'>{{$errors->first('name')}}</b>
		</div>
	</div> 
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='hh' id="firstname">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='price' id="firstname">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品缩略图</label>
		<div class="col-sm-10">
			<input type="file" name="img" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name='kc' id="firstname">
		</div>
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio" name='jp' value='1' checked>是
			<input type="radio" name='jp' value='2'>否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否热卖</label>
		<div class="col-sm-10">
			<input type="radio" name='rm'value='1' checked>是
			<input type="radio" name='rm' value='2'>否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否上架</label>
		<div class="col-sm-10">
			<input type="radio" name='sj' value='1' checked>是
			<input type="radio" name='sj' value='2'>否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品详情</label>
		<div class="col-sm-10">
			<textarea name="desc"></textarea>
		</div>
	</div>
		<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">相册</label>
		<div class="col-sm-10">
			<input type="file" name="imgs[]" multiple="multiple" class="form-control">
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
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>