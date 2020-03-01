<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
use App\Student;
use App\Http\Requests\StoreStudentPost;
use Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
        $name=request()->name??'';
        $class=request()->class??'';
        $where=[];
        if($name){
            $where[]=['name','like',"%$name%"];
        }
         if($class){
            $where[]=['class','like',"%$class%"];
        }
        // $data=DB::table('student')->select('*')->get();
        $pageSize=config('app.pageSize');
        $data=Student::where($where)->orderby('id','desc')->paginate($pageSize); 
        return view('student.index',['data'=>$data,'name'=>$name,'class'=>$class]);
    }

    /**
	 * Show the form for creating a new resource.
	 * 添加页面
	 * @return \Illuminate\Http\Response
	 */
    public function create()
    { 
        return view('student.create');
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
        // dd($data);
        // $res=DB::table('student')->insert($data);
        $validator=Validator::make($data,[
            "name"=>'required|unique:student|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u',
            'sex'=>'numeric',
            'cj'=>'required|numeric|between:1,100',
        ],[
            'name.required'=>'名字不能为空',
            'name.regex'=>'必须是真,字母,下划线,数字组成且2-12位',
            'sex.numeric'=>'性别必须为数字类型',
            'cj.required'=>'成绩不能为空',
            'cj.numeric'=>'成绩必须为数字', 
            'cj.between'=>'成绩不能超过100分',
        ]);
        if($validator->fails()){
            return redirect('student/create')
                ->withErrors($validator)
                ->withInput();
        }
        $res=Student::create($data);
        if($res){
            return redirect('/student');
        }  
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
        //$user=DB::table('student')->where('id',$id)->first();
        $user=Student::where('id',$id)->first();
        // dd($data);
        return view('student.edit',['user'=>$user]);
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
        $validator=Validator::make($user,[
            "name"=>['regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u',
            Rule::unique('student')->ignore($id),
        ],
            'sex'=>'numeric',
            'cj'=>'required|numeric|between:1,100',
        ],[
            'name.required'=>'名字不能为空',
            'name.regex'=>'必须是真,字母,下划线,数字组成且2-12位',
            'sex.numeric'=>'性别必须为数字类型',
            'cj.required'=>'成绩不能为空',
            'cj.numeric'=>'成绩必须为数字', 
            'cj.between'=>'成绩不能超过100分',
        ]);
        if($validator->fails()){
            return redirect('student/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
       // $res=DB::table('student')->where('id',$id)->update($user);
       $res=Student::where('id',$id)->update($user);
       if($res!==false){
       	    return redirect('/student');
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
        // $res=DB::table('student')->where('id',$id)->delete();
        $res=Student::destroy($id);
        if($res){
        	return redirect('/student');
        }
    }
}
