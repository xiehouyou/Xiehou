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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/','StaticPagesController@home')->name('home');
Route::get('/help','StaticPagesController@help')->name('help');
Route::get('/about','StaticPagesController@about')->name('about');
Route::get('signup','UsersController@create')->name('signup');
Route::Resource('users','UsersController');
Route::any('test1',['uses'=>'StudentController@test1']);
/*Route::get('member/info','MemberController@info');*/
/*Route::get('member/info',['uses'=>'MemberController@info']);*/
/*Route::get('member/info',[
	'uses'=>'MemberController@info',
	'as'=>'memberinfo'
]);*/
/*Route::controller('member','MemberController');*/
Route::get('member/{id}',['uses'=>'MemberController@info'])->where('id','[0-9]+');
//单请求路由
Route::get('basic1',function(){
	return 'Hello world';
});
Route::post('basic2',function(){
	return 'basic2';
});
//多请求路由
//match指定多请求响应的类型
Route::match(['get','post'],'multy1',function(){
	return 'multy1';
});
//any相应所有的请求
Route::any('multy2',function(){
	return 'multy2';
});

//路由参数，使用路由参数可以获得请求的url区段
/*Route::get('user/{id}',function($id){
	return 'User-id-'.$id;
});*/
/*Route::get('user/{name?}',function($name='xiehou'){
	return 'User-name-'.$name;
});*/
/*Route::get('user/{name?}',function($name='xiehou'){
	return 'User-name-'.$name;
})->where('name','[A-Za-z]+');*/
/*Route::get('user/{id}/{name?}',function($id,$name='xiehou'){
	return 'User-id-'.$id.'User-name-'.$name;
})->where(['id'=>'[0-9]+','name'=>'[A-Za-z]+']);*/

//路由别名(别名的优点，可以在控制器路由模板中，用route（）函数生成别对应的url)
/*Route::get('user/center',['as'=>'center',function(){
	return route('center');
}]);*/

//路由群组
Route::group(['prefix'=>'member'],function(){


	Route::get('user/center',['as'=>'center',function(){
	return route('center');
	}]);

	Route::any('multy2',function(){
	return 'member-multy2';
	});
});

//路由中输出视图
Route::get('view',function(){
	return view('welcome');
});




