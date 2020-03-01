<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Logins;
class LoginsController extends Controller
{
    public function loginsdo(Request $request){
    	$user=$request->except('_token');
    	$user['upwd']=md5(md5($user['upwd']));
    	$dl=Logins::where($user)->first();
        if($dl){
        	
        	session(['dl'=>$dl]);
        	
        $request->session()->save();
     
        $where=[];
        $where=[
           ['qx','=','1'],
          
 
        ];
        $dl=Logins::where($where)->first();
        if($dl){
        	return redirect('/hw');
        }
    }else{
        return redirect('/hw/pt');
    }
}
}
