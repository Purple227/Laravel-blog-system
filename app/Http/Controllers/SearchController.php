<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SearchController extends Controller
{
     public function search()
    {
        $posts = $tag->posts()->where([
        ['title','LIKE',"%$query%"],
        ['status', '=', '1'],
        ['is_approved', '=', '1'], 
        ])
        ->paginate(4);

        return view('user_interface/blog_search', compact('posts'));
    }
}
