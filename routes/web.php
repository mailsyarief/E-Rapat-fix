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


Auth::routes();

// Route::group(['middleware' =>['web','auth']], function(){
// 	Route::get('/', function(){
// 		return view('home');
// 	});
// 	Route::get('/home', function(){
// 		if(Auth::user()->role==0){
// 			return view('home');
// 		} 
// 		if(Auth::user()->role==1){
// 			$users['users'] = \App\User::all();
// 			return view('tendik', $users);
// 		}
// 		else {
// 			$users['users'] = \App\User::all();
// 			return view('admin', $users);
// 		}
// 	});

Route::get('/', 'UserController@index')->name('home');
Route::post('/update-akunsaya', 'UserController@update_akun');
Route::get('/rapat-saya', 'UserController@rapat_saya');

Route::get('/kelola-akun', 'AdminController@kelola_akun');
Route::post('/enable-akun', 'AdminController@enable_akun');
Route::post('/disable-akun', 'AdminController@disable_akun');
Route::post('/update-akun', 'AdminController@update_akun');
Route::post('/login-as-akun', 'AdminController@login_as_akun');
Route::post('/switch-back', 'AdminController@switch_back');

Route::get('/buat-rapat', 'RapatController@buat_rapat');
Route::post('/new-rapat', 'RapatController@create');
Route::get('/notulensi/{id}', 'RapatController@notulensi');
Route::get('/get-template/{id}', 'RapatController@get_template');
Route::post('/autosave-notulensi', 'RapatController@autosave');
Route::post('/manualsave-notulensi', 'RapatController@manualsave');
Route::get('/att-download/{id}', 'RapatController@att_download');
Route::post('/delete', 'RapatController@delete');
Route::get('/cari-rapat', 'RapatController@cari');
Route::post('/cari-rapat', 'RapatController@search');
Route::get('/cetak-rapat/{id}', 'RapatController@cetak_rapat');



Route::get('/message', 'MessageController@notify');
Route::get('/message/{email}', 'MessageController@readNotification');
Route::get('/rapat/show/{id}/{notif_id}', 'RapatController@show');

Route::get('/edit-rapat/{id}', 'RapatController@edit_rapat');
Route::post('/edit-rapat', 'RapatController@edit_rapat_post');
Route::post('/delete_att', 'RapatController@delete_att');
Route::post('/add_att', 'RapatController@add_att');
Route::post('/delete_peserta', 'RapatController@delete_peserta');
Route::post('/add_peserta', 'RapatController@add_peserta');






