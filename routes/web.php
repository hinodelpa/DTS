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

Route::group(['middleware' => 'guest'], function(){
	Route::get('/', function () {
		return view('welcome');
	});
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
	Route::get('home', function(){
		if(Auth::user()->role == 1){
			return view('dashboard');
		}else{
			return view('dashboard-pengguna');
		}
	})->name('home');
});

Route::get('/register', 'Auth\RegisterController@showRegisForm')->name('register');
Route::post('/register', 'Auth\RegisterController@store')->name('register.submit');

Route::get('HTML-404', ['as' => 'notfound', 'uses' => 'HomeController@pagenotfound']);

Route::group(['middleware' => 'auth'], function () {

	// ROUTE GENERAL
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	// ADMIN
	Route::resource('user', 'UserController', ['except' => ['show']]);

	// DEALER
	// Route::resource('dealer', 'DealerController');
	Route::get('/dealer', 'DealerController@index')->name('dealer.index');
	Route::get('/dealer/create', 'DealerController@create')->name('dealer.create');
	Route::get('/dealer/{id}/edit', 'DealerController@edit')->name('dealer.edit');
	Route::put('/dealer/{id}','DealerController@update')->name('dealer.update');
	Route::post('/dealer/store', 'DealerController@store')->name('dealer.store');
	Route::delete('/dealer/delete/{id}', 'DealerController@destroy')->name('dealer.destroy');

	// KARYAWAN
	Route::get('/karyawan', 'KaryawanController@index')->name('karyawan.index');
	Route::get('/karyawan/create', 'KaryawanController@create')->name('karyawan.create');
	Route::get('/karyawan/{id}/edit', 'KaryawanController@edit')->name('karyawan.edit');
	Route::put('/karyawan/{id}','KaryawanController@update')->name('karyawan.update');
	Route::post('/karyawan/store', 'KaryawanController@store')->name('karyawan.store');
	Route::delete('/karyawan/delete/{id}', 'KaryawanController@destroy')->name('karyawan.destroy');

});

