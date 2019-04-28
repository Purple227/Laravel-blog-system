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

Route::get('blog/author/{name}', 'AuthorController@blogByAuthor')->name('blog.author');
Route::get('blog/search','BlogController@blogBySearch')->name('blog.search');
Route::get('blog', 'BlogController@blog')->name('blog');
Route::get('blog/{slug}', 'BlogController@blogSingle')->name('blog.single');
Route::get('blog/category/{slug}', 'BlogController@blogByCategory')->name('blog.category');
Route::get('blog/tag/{slug}', 'BlogController@blogByTag')->name('blog.tag');

Route::post('subscriber','SubscriberController@store')->name('subscriber.store');


Route::group(['namespace'=>'Admin', 'middleware'=>['auth','admin']], function()
{	
	Route::get('admin/post/pending', 'PostController@pending')->name('post.pending');
	Route::resource('admin/post', 'PostController');
	Route::put('admin/post/{id}/approve','PostController@approval')->name('post.approve');

	Route::get('admin/dashboard', 'DashboardController@dashboard')->name('admin.dashboard');

    Route::get('admin/subscriber', 'SubscriberController@index')->name('subscriber');
    Route::delete('subscriber/{id}','SubscriberController@destroy')->name('subscriber.destroy');

    Route::get('admin/user', 'UserController@authUser')->name('auth.user');
    Route::get('admin/author', 'UserController@author')->name('author');
    Route::get('admin/super-user', 'UserController@admin')->name('admin');
    Route::put('author/{id}/author', 'UserController@updateToAuthor')->name('update.author');
    Route::put('admin/{id}/admin', 'UserController@updateToAdmin')->name('update.admin');
     Route::put('user/{id}/user', 'UserController@updateToUser')->name('update.user');
    Route::delete('users/{id}/users','UserController@destroy')->name('user.destroy');
});


Route::group(['namespace'=>'Author', 'middleware'=>['auth','author']], function()
{	
	Route::get('author/post/pending', 'PostController@pending')->name('author.post.pending');
	Route::resource('author/post', 'PostController')->names([
    'create' => 'author.post.create', 'index' => 'author.post.index', 'store' => 'author.post.store', 'destroy' => 'author.post.destroy', 'update' => 'author.post.update', 'show' => 'author.post.show', 'edit' => 'author.post.edit']);

	Route::get('author/dashboard', 'DashboardController@dashboard')->name('author.dashboard');
});


Route::group(['namespace'=>'Auth', 'middleware'=>['auth']], function(){
  
  Route::get('user/{id}/edit', 'UserController@edit')->name('profile.edit');
  Route::put('update-profile/{id}', 'UserController@updateProfile')->name('update.profile');
  Route::get('user/{id}', 'UserController@userProfile')->name('user.profile');

  Route::post('comment/{id}','CommentController@storeComment')->name('comment.store');

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
View::composer(['layouts.frontend.partial.footer','layouts.backend.partial.footer'], function ($view) {
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


