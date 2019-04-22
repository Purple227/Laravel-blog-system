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

Route::get('blog/search','BlogController@search')->name('blog.search');
Route::get('blog', 'BlogController@blog')->name('blog');
Route::get('blog/{slug}', 'BlogController@blogSingle')->name('blog.single');
Route::get('blog/category/{slug}', 'BlogController@category')->name('blog.category');
Route::get('blog/tag/{slug}', 'BlogController@tag')->name('blog.tag');

Route::post('subscriber','SubscriberController@store')->name('subscriber.store');


Route::group(['namespace'=>'Admin', 'middleware'=>['auth','admin']], function()
{	
	Route::get('admin/post/pending', 'PostController@pending')->name('post.pending');
	Route::resource('admin/post', 'PostController');
	Route::put('admin/post/{id}/approve','PostController@approval')->name('post.approve');

	Route::get('admin/dashboard', 'DashboardController@dashboard')->name('dashboard');

    Route::get('subscriber', 'SubscriberController@index')->name('subscriber');
    Route::delete('subscriber/{id}','SubscriberController@destroy')->name('subscriber.destroy');
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


//Views Composer 
View::composer('layouts.frontend.partial.navbar', function ($view) {
    $categories = App\Category::all();

    if (count($categories) <= 6) {
    $categories = App\Category::all()->take(3);
    }
    else 
    {
    $categories = $categories->random(3);
    $categories->take(3);
    }
   $view->with('categories',$categories);
});


//Views Composer 
View::composer('layouts.frontend.partial.footer', function ($view) {
    $categories = App\Category::all();

    if (count($categories) <= 6) {
    $categories = App\Category::all()->take(3);
    }
    else 
    {
    $categories = $categories->random(3);
    $categories->take(3);
    }
   $view->with('categories',$categories);
});


