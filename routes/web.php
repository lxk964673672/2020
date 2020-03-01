<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 
// Route::get('/', function () {
// 	$name='1908 欢迎你';
//     return view('welcome',['name'=>$name]);
// });
Route::get('/','Index\LoginController@index');//首页
Route::get('/index/login','Index\LoginController@login');//登录
Route::get('/index/reg','Index\LoginController@reg');//注册
Route::view('/login','index.login');//登录页面
Route::view('/reg','index.reg');//注册页面
Route::get('/index/proinfo','Index\LoginController@proinfo');//详情

Route::get('/regdo','Index\LoginController@regdo');//执行添加
Route::post('/index/logindo','Index\LoginController@logindo');//验证登录
//发送短信
Route::get('/send','Index\LoginController@ajaxsend');
 

Route::get('/show',function(){
	echo '这里是商品详情页面';
});
Route::get('/shows',function(){
	echo '这里是商品详情页面';
});
Route::get('/show/{id}',function($id){
	echo '商品id是:'.$id;
});
Route::get('/show/{id}/{name}',function($id,$name){
	echo '商品id是:'.$id;
	echo '商品是:'.$name;
})->where(['name'=>'\w+']);//正则约束

 

Route::get('/brand/add','UserController@add');//添加页面第一种方法
Route::post('/brand/adds','UserController@adddo');//第二种

Route::get('/cartgory','UserController@cartgory');
Route::post('/adddo','UserController@adddo')->name('do');

//外来务工人员统计
Route::prefix('people')->middleware('checklogin')->group(function(){

Route::get('create','PeopleController@create');//添加页面
Route::post('store','PeopleController@store');//执行添加
Route::get('/','PeopleController@index');//首页

Route::get('edit/{id}','PeopleController@edit');//编辑页面
Route::post('update/{id}','PeopleController@update');//执行编辑
Route::get('delete/{id}','PeopleController@destroy');//删除
 });
Route::view('/admin/login','login');//登录页面
Route::post('/logindo','LoginController@logindo');//执行编辑
//学生表
Route::prefix('student')->group(function(){

Route::get('create','StudentController@create');//添加页面
Route::post('store','StudentController@store');//执行添加
Route::get('/','StudentController@index');//首页

Route::get('edit/{id}','StudentController@edit');//编辑页面
Route::post('update/{id}','StudentController@update');//执行编辑
Route::get('destroy/{id}','StudentController@destroy');//删除
});

//考试
Route::prefix('news')->middleware('logina')->group(function(){
Route::get('create','NewsController@create');//添加页面
Route::post('store','NewsController@store');//执行添加
Route::get('/','NewsController@index');//首页

Route::get('edit/{id}','NewsController@edit');//编辑页面
Route::post('update/{id}','NewsController@update');//执行编辑
Route::get('destroy/{id}','NewsController@destroy');//删除

 });
Route::view('/logina','logina');//登录页面
Route::post('/logindoa','Logina@logindoa');//执行编辑
//ajax验证唯一性
Route::post('/news/checkOnly','NewsController@checkOnly');

//商品分类
Route::get('/category/create',"CategoryController@create");
Route::post('/category/store',"CategoryController@store");
Route::get('/category',"CategoryController@index");

//商品表
Route::get('/goods/create','GoodsController@create');//添加页面
Route::post('/goods/store','GoodsController@store');//执行添加
Route::get('/goods','GoodsController@index');//首页
Route::get('/goods/show/{id}','GoodsController@show');//首页

 
Route::get('/goods/edit/{id}','GoodsController@edit');//编辑页面
Route::post('/goods/update/{id}','GoodsController@update');//执行编辑
Route::get('/goods/delete/{id}','GoodsController@delete');//删除
 
Route::get('/users/create','Users@create');//添加页面
Route::post('/users/store','Users@store');//执行添加
Route::get('/users','Users@index');//首页
 Route::get('/users/edit/{id}','User@edit');//编辑页面
Route::post('/users/update/{id}','Users@update');//执行编辑
Route::get('/users/destroy/{id}','Users@destroy');//删除


//考试
Route::prefix('hw')->group(function(){
Route::get('create','HwController@create');//添加页面
Route::post('store','HwController@store');//执行添加
Route::get('/','HwController@index');//首页
Route::get('pt','HwController@pt');//首页
Route::get('delete/{id}','HwController@delete');//删除

 });
Route::view('/logins','logins');//登录页面
Route::post('/logins/loginsdo','loginsController@loginsdo');//验证登录
 
 