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
<center><h1>文章展示</h1></center><hr/>
<form>
<select name="cate_id">
	<option value="">请选择分类</option>
	@php $cate_id=$query['cate_id']??''; @endphp
	@foreach($cate as $v)
	<option value="{{$v->cate_id}}" @if($v->cate_id==$cate_id) selected="selected" @endif>{{$v->cate_name}}</option>
	@endforeach
</select>
	<input type="text" name="title" value="{{$query['title']??''}}" placeholder="请输入文章标题">
	
	<input type="submit" value="搜索">
</form>
<table class="table table-bordered">
	<caption>展示页面</caption>
<thead>
	<tr>
		<th>ID</th>
		<th>网址标题</th>
		<th>文章分类</th>
		<th>文章重要性</th>
		<th>是否显示</th>
		<th>添加日期</th>
		<td>图片</td>
		<th>操作</th>
	</tr>
</thead>
<tbody>
	@foreach($data as $k=>$v)
	<tr @if($k%2==0) class='active' @else class='success' @endif>
		<td>{{$v->n_id}}</td>
		<td>{{$v->title}}</td>
		<td>{{$v->cate_name}}</td>
		<td>{{$v->is_import}}</td>
		<td>{{$v->is_show==1?'√':'×'}}</td>
		<td>{{date('Y-m-d H:i:s',$v->time)}}</td>
		<td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}"width='40px' height='40px'>@endif</td>
        <td>
        	<a href="{{url('news/edit/'.$v->n_id)}}">编辑</a>|
            <a href="javascript:void(0)" onclick="del({{$v->n_id}})">删除</a>
        </td>
	</tr>
	@endforeach
 <tr><td colspan='7'>{{$data->appends($query)->links()}}</td></tr>
</tbody>
</table>

<script>
	//ajax分页
	// $('.pagination a').click(function(){
	$(document).on('click','.pagination a',function(){
		var url=$(this).attr('href');
		if(!url){
			return;
		}
		$.get(url,function(result){
			$('tbody').html(result);
		});
		return false;
	})
	//ajax删除
	function del(id){
        if(!id){
	        return;
        }
		if(confirm('是否要删除此条记录')){
			//ajax删除
		$.get('/news/destroy/'+id,function(result){
			if(result.code=='00000'){
				location.reload();
			}
		},'json')
    }
}
 
</script>
</body>
</html>
