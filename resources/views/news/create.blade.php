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
<form action="{{url('/news/store')}}" method="post" enctype='multipart/form-data'>
		@csrf
	<table>
		<tr>
			<td style="text-align:right;">文章标题</td>
			<td><input type="text" name="title">
                <b style="color:red">{{$errors->first('sname')}}</b>
			</td>
		</tr>
		<tr>
			<td style="text-align:right;">文章分类</td>
			<td>
				<select name='cate_id'>
				  @foreach($cate as $v)
				    <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
			      @endforeach
			    </select>
		    </td>
		</tr>
		<tr>
			<td style="text-align:right;">文章重要性</td>
			<td><input type="radio" name="is_import" value="1" checked>普通<input type="radio" name="is_import" value="2">置顶</td>
		</tr>
		<tr>
			<td style="text-align:right;">是否显示</td>
			<td><input type="radio" name="is_show" value="1" checked>显示<input type="radio" name="is_show" value="2">不显示</td>
		</tr>
		<tr>
			<td style="text-align:right;">文章作者</td>
			<td><input type="text" name="author">
                <b style="color:red">{{$errors->first('szz')}}</b>
			</td>
		</tr>
		<tr>
			<td style="text-align:right;">作者email</td>
			<td><input type="text" name="email">
                <b style="color:red">{{$errors->first('semail')}}</b>
			</td>
		</tr> 
		<tr>
			<td style="text-align:right;">上传文件</td>
			<td><input type="file" name="img"></td>
		</tr>
		<tr>
			<td colspan='2' style="text-align:center;"><input type="button" value="添加"></td>
		</tr>
	</table>
</form>
 
<script>
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
     
	$('input[type="button"]').click(function(){
	    var titleflag=true;	
        $('input[name="title]').next().html('');
        //标题验证
		var title=$('input[name="title"]').val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(title)){
	    $('input[name="title"]').next().html('文章标题由中文字母数字组成且不能为空');
			return;
		}
		//验证唯一性
	    $.ajax({
	    	type:'post',
	    	url:"/news/checkOnly",
	    	data:{title:title},
	    	async:false,
	    	dataType:"json",
	    	success:function(result){
	    		if(result.count>0){
	    		$("input[name='title']").next().html('标题已存在');
	    		titleflag=false;	
	    	}
	    	}
	    });
        if(!titleflag){
            return;
        }
	    //作者验证
        var author=$('input[name="author"]').val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
		if(!reg.test(author)){
			$('input[name="author"]').next().html('作者由中文字母数字组成且不能为空 长度为2-8位');
			return;
		}
		//form 提交
		$('form').submit();
	   });
	$('input[name="title"]').blur(function(){
	    $(this).next().html('');
		var title=$(this).val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(title)){
			$(this).next().html('文章标题由中文字母数字组成且不能为空');
			return;
		}
		$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	    //验证唯一性
	    $.ajax({
	    	type:'post',
	    	url:"/news/checkOnly",
	    	data:{title:title},
	    	dataType:"json",
	    	success:function(result){
	    		if(result.count>0){
	    		$("input[name='title']").next().html('标题已存在');
	    	}
	    	}
	    });
    })
</script>
</body>
</html>