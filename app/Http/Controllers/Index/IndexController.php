<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
class IndexController extends Controller
{
    public function index(){
    	return view('index.index');
    }
}