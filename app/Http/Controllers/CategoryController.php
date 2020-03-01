<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $res=Category::all();
       $cate=$this->CreateTree($res);
       return view('category.index',['cate'=>$cate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        
        $cate=Category::all();
          $cate=$this->CreateTree($cate);
        return view('category.create',['cate'=>$cate]);
    }
    public function CreateTree($data,$parent_id=0,$level=1){
        if(!$data){
            return;
        }
        static $newarray=[];
        foreach ($data as $k=>$v){
            if($v->parent_id==$parent_id){
                $v->level=$level;
                $newarray[]=$v;
                //调用自身
                $this->CreateTree($data,$v->cate_id,$level+1);
            }
        }
        return $newarray;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=$request->except('_token');
        $res=Category::create($post);
        if($res){
            return redirect('/category');
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
       showMsg(1,'Hello World!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
