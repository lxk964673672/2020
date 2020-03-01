<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Brand;
use App\Goods;
use App\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Cache::flush(); //清除缓存
        echo 123；
        $name=request()->name??'';
        $where=[];
        if($name){
            $where[]=['name','like',"%$name%"];
        }
         
        // 接受当前页码
        $page=request()->page??1;
        // echo 'goods_'.$page.'_'.$name;
        // // $goods=Cache::get('goods'); ////第一种
        // $goods=cache('goods_'.$page.'_'.$name);
        // dump($goods);
        $goods=Redis::get('goods_'.$page.'_'.$name);
        if(!$goods){
        echo '走DB==';
        
        $pageSize=config('app.pageSize');
        // echo $pageSize;exit;
        $goods=Goods::leftJoin('category','goods.cate_id','=','category.cate_id')
            ->leftJoin('brand','goods.brand_id','=','brand.brand_id')
            ->where($where)
            ->orderby('id','desc')
            ->paginate($pageSize); 
            //存入缓存
        // Cache::put('goods',$goods,60*60*24*30);
        // cache(['goods_'.$page.'_'.$name=>$goods],60*60*24*30);
        //序列化结果集 将字符串转换为object对象
        $goods=serialize($goods);
        Redis::setex('goods_'.$page.'_'.$name,20,$goods);
        }
        //反序列化结果集 将object转换为字符串
        $goods=unserialize($goods);
        return view('goods.index',['goods'=>$goods,'query'=>request()->all()]);
       
    }
    public function show($id){
        //访问量
        $count=Redis::setnx('num_'.$id,1);
        
        if(!$count){
            $count=Redis::incr('num_'.$id);
        }
        $goods=Goods::find($id);
        return view('goods.show',['goods'=>$goods,'count'=>$count]);
    }
    /**
     * Show the form for creating a new resource.
     * 添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $brand=Brand::all();
        $cate=Category::all();
        $cate=$this->CreateTree($cate);
        return view('goods.create',['brand'=>$brand,'cate'=>$cate]);
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
     * 执行添加
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        // dd($data);
        // $data['hh']=$this->CreateGoodsSn();
        //文件上传
        if($request->hasFile('img')){
            $data['img']=$this->uploads('img');
            // dd($img);
        }
        if($data['imgs']){
            $photos=$this->Moreuploads('imgs');
            $data['imgs']= implode('|',$photos);
        }
        $res=Goods::create($data);
        // dd($res);
        if($res){
            return redirect('/goods');
        }  
    }
    // public function CreateGoodsSn(){
    //     return 'good'.date('YmdHis').rand(1000,9999);
    // } 
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
    public function Moreuploads($filename){
        $photo=request()->file($filename);
        if(!is_array($photo)){
            return;
        }
        foreach($photo as $v){
            if($v->isValid()){
                $store_result[]=$v->store('uploads');
            }
        }
        return $store_result;
    }
    /**
     * Display the specified resource.
     * 预览详情页
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
     

    /**
     * Show the form for editing the specified resource.
     * 编辑页面 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand=Brand::all();
        $cate=Category::all();
        $cate=$this->CreateTree($cate);
     
        // $user=DB::table('goods')->where('p_id',$id)->first();
         $user=goods::where('id',$id)->first();

        // dd($data);
        return view('goods.edit',['user'=>$user,'brand'=>$brand,'cate'=>$cate]);
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
        if($request->hasFile('img')){   
            $user['img']=$this->upload('img');
        }

       // dd($data);
       // $res=DB::table('goods')->where('p_id',$id)->update($user);
       $res=goods::where('id',$id)->update($user);
       if($res!==false){
            return redirect('/goods');
       }
    }
    /**
     * Show the form for editing the specified resource.
     * 删除
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // $res=DB::table('goods')->where('p_id',$id)->delete();
        $res=goods::destroy($id);
        if($res){
            return redirect('/goods');
        }
    }
}
