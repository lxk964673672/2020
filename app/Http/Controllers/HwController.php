<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Hw;
use App\Dl;
class HwController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=Hw::all();
        return view('hw.index',['res'=>$res]);
    }
     public function pt()
    {
       $res=Hw::all();
        return view('hw.pt',['res'=>$res]);
    }
    /**
     * Show the form for creating a new resource.
     * 添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('hw.create');
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
        $data['time']=time();
        $res=Hw::create($data);
        // dd($res);
        if($res){
            return redirect('/hw');
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
   
    }
    /**
     * Show the form for editing the specified resource.
     * 删除
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // $res=DB::table('hw')->where('p_id',$id)->delete();
        $res=Hw::destroy($id);
        if($res){
            return redirect('/hw');
        }
    }
}
