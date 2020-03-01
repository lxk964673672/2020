<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	echo 'hellow word';
    }
    public function add(){
       return view('user.add');
    }
    public function adddo(Request $request){
    	$data=$request->all();
    	dd($data);
    }
    public function cartgory(){
    	$fid='服装';
    	return view('user.cartgory',['fid'=>$fid]);
    }
}
