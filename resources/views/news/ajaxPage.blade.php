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