<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Tag;
use App\User;

class DashboardController extends Controller
{
    public function dashboard()
    {   

    	$top_post = Auth::user()->posts()
    	            ->withCount('comments')
                    ->orderBy('view_count','desc')
                    ->orderBy('comments_count','desc')
                    ->take(5)->get();

        $top_author = User::Author()
    	             ->withCount('posts')
                     ->withCount('comments')
                     ->orderBy('posts_count','desc')
                     ->orderBy('comments_count','desc')
                     ->take(5)->get();

        $latest_author = User::Author()->orderBy('id')->take(3)->get();

        $category = Category::count();
    	$tag = Tag::count();

    	$posts = Auth::user()->posts()->count();
    	$pending = Auth::user()->posts()->where('is_approved',0)->count();

    	$total_view = Auth::user()->posts()->sum('view_count');

                $most_active_user = User::AuthUser()
                            ->withCount('comments')
                            ->orderBy('comments_count')
                            ->take(5)->get();

    	return view('author/dashboard', compact('top_post', 'top_author', 'latest_author', 'category', 'tag', 'posts', 'total_view', 'pending', 'most_active_user'));
    }
}
