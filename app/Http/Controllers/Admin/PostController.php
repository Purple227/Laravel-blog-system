<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all()->sortKeysDesc();
        $post_count = Post::count();
        return $post;
        return view('admin/post/index', compact('post', 'post_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $tag = Tag::all()->sortKeysDesc();
        $category = Category::all()->sortKeysDesc();
        return view('admin/post/create', compact('tag', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,[
            'title' => 'required',
            'image' => 'required',
            'category_id' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]); 

        $image = $request->file('image');

        $slug = str_slug($request->title);
        $shorten_slug = substr($slug, 0, 15);
        $slug = $shorten_slug; 
        $slug = str_replace(" ", "-", $slug); 

        if(isset($image))
        {
            $image_name = $slug.'.'.$image->getClientOriginalExtension();
        }

        if (!Storage::disk('public')->exists('post')) 
        {
            Storage::disk('public')->makeDirectory('post');
        }

        $post_image = Image::make($image)->resize(400,300);
        Storage::disk('public')->put('post/'.$image_name,$post_image);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $image_name;
        $post->description = $request->description;
        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }

        $post->is_approved = true;

        //This will be done later
       /* if( Auth::user()->role_id == 1)
        {
            $post->view_count = 680;
            //This will be scheduled to run daily or so.
        } */

        $post->save();

        $post->tags()->attach($request->tags);


        $request->session()->flash('success', 'Task was successful!');
        return redirect()->route('post.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $post = Post::find($id);
        $tag = Tag::all()->sortKeysDesc();
        $category = Category::all()->sortKeysDesc();
        return view('admin/post/edit', compact('tag', 'category', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

         $this->validate($request,[
            'title' => 'required',
            'image' => 'required',
            'category_id' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]); 

        $image = $request->file('image');


        if(isset($image))
        {
            $image_name = $slug.'.'.$image->getClientOriginalExtension();
        }

        if (!Storage::disk('public')->exists('post')) 
        {
            Storage::disk('public')->makeDirectory('post');
        }

        $post_image = Image::make($image)->resize(400,300);
        Storage::disk('public')->put('post/'.$image_name,$post_image);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->image = $image_name;
        $post->description = $request->description;
        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }

        $post->is_approved = true;

        //This will be done later
       /* if( Auth::user()->role_id == 1)
        {
            $post->view_count = 680;
            //This will be scheduled to run daily or so.
        } */

        $user->categories()->associate($request->category_id);

        $post->save();

        $post->tags()->attach($request->tags);


        $request->session()->flash('success', 'Task was successful!');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
