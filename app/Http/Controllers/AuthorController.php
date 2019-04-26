<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthorController extends Controller
{
     public function blogByAuthor($name)
    {
        $author = User::where('name',$name)->first();
        $posts = $author->posts()->approved()->published()->paginate(4);;
        return view('user_interface/blog_author', compact('posts', 'author'));
    }

}
