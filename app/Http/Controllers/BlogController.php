<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public function blog()
    {
        $posts = Post::where([
        ['status', '=', '1'],
        ['is_approved', '=', '1'], 
        ])
        ->paginate(4);
        return view('user_interface/blog', compact('posts'));
    }

    public function blogSingle($slug)
    {
        $post = Post::where('slug',$slug)->first();

         $blogKey = 'blog_' . $post->id;
        if (!Session::has($blogKey)) {
            $post->increment('view_count');
            Session::put($blogKey,1);
        }

        return view('user_interface/blog_single', compact('post'));
    }


    public function category($slug)
    {
        $category = Category::where('slug',$slug)->first();
        $posts = $category->posts()->where([
        ['status', '=', '1'],
        ['is_approved', '=', '1'], 
        ])
        ->paginate(4);

        return view('user_interface/blog_categories', compact('category', 'posts'));
    }

     public function tag($slug)
    {
        $tag = Category::where('slug',$slug)->first();
        $posts = $tag->posts()->where([
        ['status', '=', '1'],
        ['is_approved', '=', '1'], 
        ])
        ->paginate(4);

        return view('user_interface/blog_tag', compact('tag', 'posts'));
    }

      public function search(Request $request)
    {   
        $query = $request->input('query');
        
        $posts = Post::where([
        ['title','LIKE',"%$query%"],
        ['status', '=', '1'],
        ['is_approved', '=', '1'], 
        ])
        ->paginate(4);

        return view('user_interface/blog_search', compact('posts', 'query'));
    }
}
