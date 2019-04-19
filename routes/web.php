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
	Route::get('admin/post/pending', 'PostController@pending')->name('post.pending');
	Route::resource('admin/post', 'PostController');
	Route::put('admin/post/{id}/approve','PostController@approval')->name('post.approve');

	Route::get('admin/dashboard', 'DashboardController@dashboard')->name('dashboard');
});


Route::group(['namespace'=>'Author', 'middleware'=>['auth','author']], function()
{	
	Route::get('author/post/pending', 'PostController@pending')->name('post.pending');
	Route::resource('author/post', 'PostController');

	Route::get('author/dashboard', 'DashboardController@dashboard')->name('dashboard');
});



Route::group(['namespace'=>'Tag_Category', 'middleware'=>['auth']], function()
{	
	Route::resource('category', 'CategoryController')->except('create','show');
	Route::resource('tag', 'TagController')->except('create','show');
});

