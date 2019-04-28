<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Tag;
use App\Category;

class DashboardController extends Controller
{
    public function dashboard()
    {   

    	$posts = Post::count();
    	$pending = Post::where('is_approved',0)->count();

    	$authors = User::Author()->count();

    	$top_post = Post::withCount('comments')
                    ->orderBy('view_count','desc')
                    ->orderBy('comments_count','desc')
                    ->take(5)->get();

    	$total_view = Post::sum('view_count');

    	$top_author = User::Author()
    	              ->withCount('posts')
                      ->withCount('comments')
                      ->orderBy('posts_count','desc')
                      ->orderBy('comments_count','desc')
                      ->take(5)->get();

    	$most_active_user = User::AuthUser()
    						->withCount('comments')
    						->orderBy('comments_count')
    						->take(5)->get();


    	$latest_author = User::Author()->orderBy('id')->take(3)->get();

    	$category = Category::count();
    	$tag = Tag::count();



    	return view('admin/dashboard', compact('posts', 'pending', 'top_post', 'top_author', 'category', 'tag', 'most_active_user', 'total_view', 'latest_author', 'authors'));
    }
}
