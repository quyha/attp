<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//=======================Admin=========================
	Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	]);


	Route::group(array('prefix'=>'admin','middleware'=>'auth'),function(){


			///======================== Home admin =================
			Route::get('/','Admin\HomeController@home');


			//========================= User ===================================
			Route::get('/quan-tri-vien','Admin\UserController@list_user');
			Route::get('/add_user','Admin\UserController@add_user');
			Route::post('/do_add_user', 'Admin\UserController@do_add_user');
			Route::get('/edit_user/{id}','Admin\UserController@edit_user');
			Route::post('/do_edit_user/{id}', 'Admin\UserController@do_edit_user');
			Route::get('/delete_user/{id}','Admin\UserController@delete_user');

			//==================================================================
			

		});

//=================================================================

Route::auth();

Route::get('/home', 'HomeController@index');
//===================================================================


// Route::get('/','MasterController@getVn'
// 	//if(Session::get('locale')==null) Session::put('locale','vn');
// 	//return redirect('/vn');
// );
// Route::get('/vn',function(){
// 	return redirect('/');
// });
Route::get('/',function(){
	return redirect('/vn');
});
Route::get('/{locale}','MasterController@get');
Route::get('/{locale}/tin-tuc','MasterController@list_news');
Route::get('/{locale}/van-ban-phap-luat','MasterController@list_document');
Route::get('/{locale}/nghien-cuu-khoa-hoc','MasterController@list_science');
Route::get('/{locale}/{cate}/{kind}','MasterController@cate_news');
Route::get('/{locale}/{cate}/{kind}/{slug}','MasterController@detail_news');

