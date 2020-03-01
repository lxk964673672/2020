<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Admin;
class Logina extends Controller
{
    public function logindoa(Request $request){
    	$user=$request->except('_token');
    	$user['password']=md5(md5($user['password']));
    	$admin=Admin::where($user)->first();
        if($admin){
        	
        	session(['admin'=>$admin]);
        	
        	$request->session()->save();
        	
        	return redirect('/news');
        }
    }
}
