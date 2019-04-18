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

Route::get('/', 'HomeController@index')->name('home');


Route::group(['namespace'=>'Admin', 'middleware'=>['auth','admin']], function()
{
	Route::resource('admin/post', 'PostController');
	Route::get('admin/pending', 'PostController@pending')->name('post.pending');

	Route::get('admin/dashboard', 'DashboardController@dashboard')->name('dashboard');

	Route::resource('admin/category', 'CategoryController')->except('create');
	Route::resource('admin/tag', 'TagController')->except('create');
});


