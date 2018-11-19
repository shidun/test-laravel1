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

Route::get('/', function () {
    return view('welcome');
});

Route::get('basic1', function () {
    return 'hello world';
});

Route::post('basic2', function () {
    return 'basic2';
});
//多请求路由
Route::match(['get', 'post'], 'multy1', function() {
	return 'multy';
});

Route::any('multy2', function() {
	return 'multy2';
});

// //路由参数
// Route::any('user/{id}', function($id) {
// 	return 'user-id='.$id;
// });

// //路由参数可选
// Route::any('user/{name?}', function($name = null) {
// 	return 'user-name='.$name;
// });

// //路由参数可选
// Route::any('user/{name?}', function($name = 'shidun') {
// 	return 'user-name='.$name;
// })->where('name', '[A-Za-z]+');

//路由参数可选
// Route::get('user/{id}/{name?}', function($id, $name = 'shidun') {
// 	return 'user-id'. $id .'-name='.$name;
// })->where(['id' => '[0-9]+','name' => '[A-Za-z]+']);

//路由别名
// Route::get('user/center', ['as' => 'center', function() {
// 	return route('center');
// }]);

//路由群组
Route::group(['prefix' => 'member'], function() {
	Route::get('user/center', ['as' => 'center', function() {
		return route('center');
	}]);

	Route::any('multy2', function() {
		return 'member-multy2';
	});
});

//路由中输出视图
Route::get('view', function() {
	return view('welcome');
});

// Route::get('member/info', 'MemberController@info');

// Route::get('member/info', ['uses'=>'MemberController@info']);

// Route::any('member/info', [
// 	'uses'=>'MemberController@info',
// 	'as' => 'memberinfo'
// ]);

//传入的id参数进行数学校验
Route::get('member/{id}', ['uses'=>'MemberController@info'])
->where('id', '[0-9]+');

//传入的id参数进行数学校验
Route::get('test1', ['uses'=>'StudentController@test1']);

Route::get('query', ['uses'=>'StudentController@query']);

Route::get('query2', ['uses'=>'StudentController@query2']);

Route::get('query3', ['uses'=>'StudentController@query3']);

Route::get('query4', ['uses'=>'StudentController@query4']);

Route::get('query5', ['uses'=>'StudentController@query5']);

Route::get('orm1', ['uses'=>'StudentController@orm1']);

Route::get('orm2', ['uses'=>'StudentController@orm2']);

Route::get('orm3', ['uses'=>'StudentController@orm3']);

Route::get('orm4', ['uses'=>'StudentController@orm4']);

Route::get('section1', ['uses'=>'StudentController@section1']);

Route::get('url', ['as'=>'url', 'uses'=>'StudentController@urlTest']);

Route::get('request1', ['uses'=>'StudentController@request1']);
Route::group(['middleware' => ['web']], function() {
	Route::get('session1', ['uses'=>'StudentController@session1']);

	Route::get('session2', [
		'as' => 'session2',
		'uses'=>'StudentController@session2'
	]);
});

Route::get('responses', ['uses'=>'StudentController@responses']);


//宣传页面
Route::get('activity0', ['uses'=>'StudentController@activity0']);
Route::group(['middleware' => ['activity']], function() {
	//活动页面
	Route::get('activity1', ['uses'=>'StudentController@activity1']);

	Route::get('activity2', ['uses'=>'StudentController@activity2']);
});

//session start
Route::group(['middleware' => ['web']], function() {
	Route::get('student/index', ['uses'=>'StudentController@index']);

	Route::any('student/create', ['uses'=>'StudentController@create']);

	Route::any('student/save', ['uses'=>'StudentController@save']);

	Route::any('student/update/{id}', ['uses'=>'StudentController@update']);

	Route::any('student/detail/{id}', ['uses'=>'StudentController@detail']);

	Route::any('student/delete/{id}', ['uses'=>'StudentController@delete']);
});

