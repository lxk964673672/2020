<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class LoginController extends Controller
{
    public function Index(){
    	return view('index.index');
    }
    public function login(){
    	return view('index.login');
    }
    public function reg(){
    	return view('index.reg');
    }
    //发送短信
    public function ajaxsend(){
    	//接受注册页面的手机号
    	$mobile=request()->mobile;
    	//$mobile=request()->mobile;
    	$code=rand(1000,9999);
        // echo $code;die;
    	$res=$this->sendSms($mobile,$code);
    	// dd($res);
    	if($res['Code']=='OK'){
    		session(['code'=>$code]);
    		request()->session()->save();

    		echo json_encode(['code'=>'00000','msg'=>'ok']);die;
    	}
    	echo json_encode(['code'=>'00001','msg'=>'短信发送失败']);die;
    }
    public function sendSms($mobile,$code){
        AlibabaCloud::accessKeyClient('LTAI4FwMd9Q8aXJg3kNH1wba','6VbMr75Ezokm4SayPTBd1bOUaXWVDd')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();
        try{
            $result=AlibabaCloud::rpc()
                        	->product('Dysmsapi')
                        	// ->scheme('https') // https | http
                        	->version('2017-05-25')
                        	->action('SendSms')
                        	->method('POST')
                        	->host('dysmsapi.aliyuncs.com')
                        	->options([
                               'query'=>[
                                    'RegionId'=>"cn-hangzhou",
                                    'PhoneNumbers'=>$mobile,
                                    'SignName'=>'有点甜矿泉水',
                                    'TemplateCode'=>"SMS_181200363",
                                    'TemplateParam'=>"{code:$code}",
                                ],
                        	])
                ->request();
         return $result->toArray();
        } catch(ClientException $e){
           return $e->getErrorMessage();     
        } catch(ServerException $e){
        	return $e->getErrorMessage();
        }                        
    }
    
    
    //注册
    public function Regdo(){
        $post=request()->except('_token');
        // dd($post);
        // 判断验证码
        $code=session('code');
        if($code!=$post['code']){
        	return redirect('/reg')->with('msg','你输入的验证码不对');
        }
        //密码和确认密码是否一直
        if($post['pwd']!=$post['repwd']){
        	return redirect('/reg')->with('msg','两次密码不一致');
        }
        //入库
        $user=[
            'mobile'=>$post['mobile'],
            'pwd'=>encrypt($post['pwd']),
            'add_time'=>time(),
        ];

        $res=Member::create($user);
        if($res){
            return redirect('/login');
        } 
    }
    public function logindo(Request $request){
    	$user=$request->except('_token');
    	$user['password']=md5(md5($user['password']));
    	$admin=Admin::where($user)->first();
        if($admin){
        	
        	session(['admin'=>$admin]);
        	
        	$request->session()->save();
        	
        	return redirect('/');
        }
    }
    //详情
    public function proinfo(){
    	return view('index.proinfo');
    }
}