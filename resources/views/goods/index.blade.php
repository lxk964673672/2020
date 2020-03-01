<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap 实列 - 水平表单</title>
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css">
    <script type="/static/js/jquery.min.js"></script>
    <script type="/static/js/bootstrap.min.js"></script>
</head>
<body>
	<form>
		<input type="text" name="name" value="{{$query['name']??''}}" placeholder="请输入要搜索的商品名称">
		<input type="submit" value="搜索">
	</form>
<center><h1>商品列表123</h1></center><hr/>
<table class="table">
	<caption>上下文表格布局</caption>
<thead>
	<tr>
		<th>商品ID</th>
		<th>商品名称</th>
		<th>商品货号</th>
		<th>商品价格</th>
		<th>商品缩略图</th>
		<th>库存</th>
		<th>是否精品</th>
		<th>是否热卖</th>
		<th>是否上架</th>
		<th>商品详情</th>
		<th>相册</th>
		<th>品牌</th>
		<th>分类</th>
		<th>操作</th>

	</tr>
</thead>
<thead>
	@foreach($goods as $k=>$v)
	<tr>
		<td>{{$v->id}}</td>
		<td>{{$v->name}}</td>
		<td>{{$v->hh}}</td>
		<td>{{$v->price}}</td>
		<td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}"width='40px' height='40px'>@endif</td>
		<td>{{$v->kc}}</td>
		<td>{{$v->jp?'√':'×'}}</td>
		<td>{{$v->rm?'√':'×'}}</td>
		<td>{{$v->sj?'√':'×'}}</td>
		<td>{{$v->desc}}</td>
		<td>
           @if($v->imgs)
           @php $photos=explode('|',$v->imgs); @endphp
           @foreach($photos as $vv)
           <img src="{{env('UPLOAD_URL')}}{{$vv}}"width='40px' height='40px'>
           @endforeach
           @endif
	    </td>
		<td>{{$v->brand_name}}</td>
		<td>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</td>
        <td>
        	<a href="{{url('goods/show/'.$v->id)}}">预览详情</a>
        	<a href="{{url('goods/edit/'.$v->id)}}">编辑</a>
            <a href="javascript:void(0)" class="del" id="{{$v->id}}">删除</a>
        </td>
	</tr>
	@endforeach
<tr><td colspan="11">{{$goods->appends($query)->links()}}</td></tr>
</thead>
</table>

 
</body>
<script type="/static/js/jquery.min.js"></script>
<script>
	$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-toke"]').attr('content')}});
	$(document).on('click','.del',function(){
		var _this=$(this);
		var id=_this.attr('id');
		if(confirm('确认删除?')){
			$.post(
                 "/goods/delete/"+id,
                 function(res){
                 	if(res.code==00000){
                 		location.reload();
                 		alert('已删除');
                 	}else{
                 		alert('删除失败');
                 	}
                 	},'json'
				)
		}
	})
</script>
</html>