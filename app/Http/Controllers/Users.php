<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Uers;
class Users extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //搜索
        $admin=request()->admin??'';
        $where = [];
        if($admin){
            $where[] =['admin','like',"%$admin%"];
        }
        //分页
        $pageSize = config('app.pageSize');
        $data=Uers::where($where)->orderby('id','desc')->paginate($pageSize);
       return view('users.index',['data'=>$data,'admin'=>$admin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 第一种验证
        $request->validate([
                'admin'=>'required|unique:users',
                'pwd'=>'required',
            ],[
                'admin.required'=>'用户不能为空',
                'admin.unique'=>'用户已存在',
                'pwd.required'=>'密码不能为空',
            ]);


        $data = $request->except('_token');
        $Uers=new Uers;
        $data['pwd'] = md5(md5($data['pwd']));
        $res=$Uers->create($data);
        if($res){
            return redirect('/users');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Uers::find($id);
        // dd($data);
        return view('users.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //第一种验证
        $request->validate([
                'admin'=>['required',
                        Rule::unique('users')->ignore($id),//,'p_id'
                ],
            ],[
                'admin.unique'=>'用户已存在',
                'admin.required'=>'用户名不能为空',
                
            ]);
        $data = $request->except('_token');

        
        $res = Uers::where('id',$id)->update($data);
        if($res!==false){
            return redirect('/adm/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Uers::destroy($id);
        if($res){
            return redirect('/users');
        }
    }
}
