<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\News;
use App\Cate; 
use App\Http\Requests\StoreNewsPost;
use Validator;
use Illuminate\Support\Facades\Cache;
class NewsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
        $cate_id=request()->cate_id??'';
        $where=[];
        if($cate_id){
            $where[]=['news.cate_id','=',$cate_id];
        }
        $title=request()->title??'';
        if($title){
            $where[]=['news.title','like',"%$title%"];
        }
        // 接受当前页码
        $page=request()->page??1;
        //从缓存里面获取分类值
        $cate=cache('cate');
        // dump($cate);
        if(!$cate){
            //获取分类数据
            $cate=Cate::get();
             //存入缓存
            cache(['cate'=>$cate],1*60);
        }
         //从缓存里获取结果值
        $data=cache('news_'.$page.'_'.$cate_id.'_'.$title);
        // dump($data);
        if(!$data){
        // echo 'db==';
        $pageSize=config('app.pageSize');
        $data=News::leftJoin('cate','news.cate_id','=','cate.cate_id')->where($where)->paginate($pageSize); 
        //存入缓存
        cache(['news_'.$page.'_'.$cate_id.'_'.$title=>$data],60*1); 
        }
        // 获取所有搜索条件 
        $query=request()->all();
        //ajax请求 即要实现ajax分页
        if(request()->ajax()){
           return view('news.ajaxPage',['data'=>$data,'cate'=>$cate,'query'=>$query]);
        }
       
        
        return view('news.index',['data'=>$data,'cate'=>$cate,'query'=>$query]);
    }
    /**
	 * Show the form for creating a new resource.
	 * 添加页面
	 * @return \Illuminate\Http\Response
	 */
    public function create()
    { 
    	$cate=Cate::get();
        // dd($data);
        return view('news.create',['cate'=>$cate]);
    }

    /**
	 * Store a newly created resource in storage.
	 * 执行添加
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        //文件上传
        if($request->hasFile('img')){
            $data['img']=$this->uploads('img');
        }
        $data['time']=time();
        $res=News::create($data);
        if($res){
            return redirect('/news');

        }  
    }
     public function uploads($filename){
        //判断上传过程有误错误
        if(request()->file($filename)->isValid()){
            //接受值
            $photo=request()->file($filename);
            //上传
            $store_result=$photo->store('uploads');
            return $store_result;
        } 
        exit("未获录取到上传文件 或者 上传过程出错");
    }
    //ajax验证
    public function checkOnly(){
        $title=reqeust()->title;
        $count=News::where(['title'=>$title])->count();
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }

    /**
	 * Display the specified resource.
	 * 预览详情页
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     * 编辑页面 
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
    public function edit($id)
    {
        //$user=DB::table('news')->where('id',$id)->first();
        $user=News::where('n_id',$id)->first();
        // dd($data);
        return view('news.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage
     * 执行编辑
     * @param  \Illminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
    public function update(Request $request,$id)
    {
        $user=$request->except('_token');
        // dd($data);
        //判断上传过程有误错误
        if($request->hasFile('img')){   
            $user['img']=$this->upload('img');
        }

          $validator=Validator::make($user,[
            "title"=>'required|unique:news|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u',
            "email"=>'required|',
            "desc"=>'required|',
        ],[
            'name.required'=>'标题不能为空',
            'name.regex'=>'必须是真,字母,下划线,数字组成且2-12位',
            'email.required'=>'邮箱不能为空',
            'desc.required'=>'描述不能为空',
        ]);
       // $res=DB::table('news')->where('id',$id)->update($user);
       $res=news::where('n_id',$id)->update($user);
       if($res!==false){
       	    return redirect('/news');
       }
    }
    /**
     * Show the form for editing the specified resource.
	 * 删除
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
    public function destroy($id)
    {
        $res=News::destroy($id);
        if($res){
        	echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
}
