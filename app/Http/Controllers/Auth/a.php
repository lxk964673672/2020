<?
use Illuminate\Http\Request;
use App\Type;
use Validator;
use Illuminate\Validation\Rule;
class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $t_name=request()->t_name??'';
        
        $where=[];
        if($t_name){
            $where[]=['t_name','like',"%$t_name%"];
        }
        $res=Type::where($where)->get();
        $res=CreateTree($res);
        // dd($res);
        return view('type.index',['res'=>$res,'t_name'=>$t_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $res=Type::all();
        $res=CreateTree($res);
        // dd($res);

        return view('pe.create',['res'=>$res]);
    }

   

    public function add()
    {   
        $t_name=request()->t_name;
        $t_id=request()->t_id??'';
        $where=[];
        if($t_name){
            $where[]=['t_name','=',$t_name];
        }
        if($t_id){
            $where[]=['t_id','!=',$t_id];
        }
        // echo $title;
        $res=Type::where($where)->count();
        // echo $res;
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$res]);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res=$request->except('_token');
        $validator = Validator::make($res,
        [
            't_name'=>'unique:type|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{1,}$/u',
        ],[
            't_name.unique'=>'分类已存在',
            't_name.regex'=>'分类名称只能使用中文、数字、字母、下滑线且不为空',
        ]);
        if ($validator->fails()){
            return redirect('type/create')
                ->withErrors($validator)
                ->withInput();
        }
        $data=Type::create($res);
        if($res){
            return redirect('type');
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
        $data=Type::find($id);
        $res=Type::get();
        // dd($res);
        return view('type.edit',['data'=>$data,'res'=>$res]);
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
        $res=$request->except('_token');
        $validator = Validator::make($res,
        [
            't_name'=>[Rule::unique('type')->ignore($id,'t_id'),'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{1,}$/u']
        ],[
            't_name.unique'=>'分类已存在',
            't_name.regex'=>'分类名称只能使用中文、数字、字母、下滑线且不为空',
        ]);
        if ($validator->fails()){
            return redirect('type/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        $data=Type::where('t_id',$id)->update($res);
        if($data!==false){
            return redirect('type');
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
        $res=Type::destroy($id);
        // dd($res);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
}