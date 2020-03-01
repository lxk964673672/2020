<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
use App\People;
use App\Http\Requests\StorePeoplePost;
use Validator;
class PeopleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {   
        $username=request()->username??'';
        $where=[];
        if($username){
            $where[]=['username','like',"%$username%"];
        }
        // DB操作
        // $data=DB::table('people')->select('*')->get();
        
        // ORM操作
        // $data=People::all();
        $pageSize=config('app.pageSize');
        // echo $pageSize;exit;
        $data=People::where($where)->orderby('p_id','desc')->paginate($pageSize);

        return view('people.index',['data'=>$data,'username'=>$username]);
    }

    /**
	 * Show the form for creating a new resource.
	 * 添加页面
	 * @return \Illuminate\Http\Response
	 */
    public function create()
    { 
        return view('people.create');
    } 
    /**
	 * Store a newly created resource in storage.
	 * 执行添加
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
    // public function store(Request $request)
    // public function store(StorePeoplePost $request)
    // 第三种验证
        public function store(Request $request)
    {

        $data=$request->except('_token');
        // dd($data);
        //第三种验证 
        $validator=Validator::make($data,[
            "username"=>'required|unique:people|max:12|min:2',
            'age'=>'required|integer|between:1,130',
        ],[
            'username.required'=>'名字不能为空',
            'username.unique'=>'名字已存在',
            'username.max'=>'名字长度不能超过12',
            'username.min'=>'名字长度不能少于2',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须为数字',
            'age.between'=>'年龄数据不合法',
            
        ]);
        if($validator->fails()){
            return redirect('people/create')
                ->withErrors($validator)
                ->withInput();
        }
        //文件上传
        if($request->hasFile('head')){
            $data['head']=$this->upload('head');
            // dd($img);
        }
        $data['add_time']=time();
        //DB
        // $res=DB::table('people')->insert($data);
        //ORM save
        // $people=new People;
        // $people->username=$data['username'];
        // $people->age=$data['age'];
        // $people->card=$data['card']; 
        // $people->head=$data['head'];
        // $people->add_time=$data['add_time'];
        // $res=$people->save();
        $res=People::create($data);
        // dd($res);
        if($res){
            return redirect('/people');
        }  
    }
    public function upload($filename){
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
        // $user=DB::table('people')->where('p_id',$id)->first();
         $user=People::where('p_id',$id)->first();

        // dd($data);
        return view('people.edit',['user'=>$user]);
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
            // dd($user);
        //判断上传过程有误错误
        if($request->hasFile('head')){   
            $user['head']=$this->upload('head');
        }

       // dd($data);
       // $res=DB::table('people')->where('p_id',$id)->update($user);
       $res=People::where('p_id',$id)->update($user);
       if($res!==false){
       	    return redirect('/people');
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
        // $res=DB::table('people')->where('p_id',$id)->delete();
        $res=People::destroy($id);
        if($res){
        	return redirect('/people');
        }
    }
}
