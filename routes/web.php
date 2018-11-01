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

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::get('signup/confirm/{token}','UsersController@confirmEmail')->name('confirm_email');

Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');//显示重置密码的邮箱发送页面
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');//邮箱发送重设链接
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');//密码更新页面
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update');//执行密码更新操作

Route::resource('statuses','statusesController',['only'=>['store','destroy']]);
Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');
Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');

/*Route::get('login','SessionsController@create')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout','SessionsController@destroy')->name('logout');
*/

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




