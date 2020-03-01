<form action="{{url('/ks/update/'.$user->id)}}" method="post" enctype='multipart/form-data'>
	<h3>编辑</h3>
		@csrf
	<table>
		<tr>
			<td>文章标题</td>
			<td><input type="text" name="name" value='{{$user->name}}'></td>
			<b style='color:red'>{{$errors->first('name')}}</b> 
		</tr>
		<tr>
			<td>文章分类</td>
			<td>
				<select name='c_id'>
				    <option value="1" @if($user->c_id==1) checked @endif>1</option>
				    <option value="2" @if($user->c_id==2) checked @endif>2</option>
			    </select>
		    </td>
		</tr>
		<tr>
			<td>文章重要性</td>
			<td><input type="radio" name="zyx" value="1" @if($user->zyx==1) checked @endif>普通<input type="radio" name="zyx" @if($user->zyx==2) checked @endif>置顶</td>
		</tr>
		<tr>
			<td>是否显示</td>
			<td><input type="radio" name="xs" value="1" @if($user->xs==1) checked @endif>显示<input type="radio" name="xs" @if($user->xs==2) checked @endif>不显示</td>
		</tr>
		<tr>
			<td>文章作者</td>
			<td><input type="text" name="zz" value='{{$user->zz}}'></td>
		</tr>
		<tr>
			<td>作者email</td>
			<td><input type="text" name="email" value='{{$user->email}}'></td>
			<b style='color:red'>{{$errors->first('email')}}</b>
		</tr>
		<tr>
			<td>关键字</td>
			<td><input type="text" name="gjz" value='{{$user->gjz}}'></td>
			<b style='color:red'>{{$errors->first('gjz')}}</b>
		</tr>
		<div>
		<tr>

			<td>图片</td>
			<div><td><input type="file" name="img"  value="{{$user->img}}" ></td>
			<img src="{{env('UPLOAD_URL')}}{{$user->img}}" width='50px' height='50px'></div>
		</tr></div>
		<tr>
			<td></td>
			<td><input type="submit" value="修改"></td>
		</tr>
	</table>
</form>