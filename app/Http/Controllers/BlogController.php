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
        $posts = Post::latest()->approved()->published()->paginate(4);
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

        $most_read = Post::all()->take(3);

        return view('user_interface/blog_single', compact('post', 'most_read'));
    }

     

    public function blogByCategory($slug)
    {
        $category = Category::where('slug',$slug)->first();
        $posts =  $category->posts()->approved()->published()->paginate(4);

        return view('user_interface/blog_categories', compact('category', 'posts'));
    }

     public function blogByTag($slug)
    {
        $tag = Category::where('slug',$slug)->first();
        $posts = $tag->posts()->approved()->published()->paginate(4);

        return view('user_interface/blog_tag', compact('tag', 'posts'));
    }

      public function blogBySearch(Request $request)
    {   
        $query = $request->input('query');
        
        $posts = Post::where('title','LIKE',"%$query%")->approved()->published()->paginate(4);

        return view('user_interface/blog_search', compact('posts', 'query'));
    }

}
