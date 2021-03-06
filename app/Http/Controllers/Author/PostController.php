<?php

namespace App\Http\Controllers\Author;

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
        $post = Auth::user()->posts()->latest()->paginate(8);
        $post_count = Auth::user()->posts()->count();
        return view('author/post/index', compact('post', 'post_count'));
    }

    public function pending()
    {
       $post = Auth::user()->posts()->where('is_approved', false)->paginate(8);
       return view('author/post/pending', compact('post'));
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
        return view('author/post/create', compact('tag', 'category'));
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
            'slug' => 'unique:posts,slug'
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

        $post_image = Image::make($image)->resize(600,350)->stream();
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
       

       $slug_check = Post::where('slug', $post->slug)->first();
       if ($slug_check == true) {
        session()->flash('fail', 'Please suffix your title!');
        return redirect()->back();
       }
       

        $post->save();

       
        $post->tags()->attach($request->tags);


        $request->session()->flash('success', 'Task was successful!');
        return redirect()->route('author.post.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('author/post.show', compact('post'));
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

        $compare_tag = Tag::all()->sortKeysDesc();
        foreach ($compare_tag as $compare_tag) {
            $compare_tag = $compare_tag->id;
        }
        
        $category = Category::all()->sortKeysDesc();

        return view('author/post/edit', compact('tag', 'category', 'post', 'compare_tag'));
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

         //delete old post image
            if(Storage::disk('public')->exists('post/'.$post->image))
            {
                Storage::disk('public')->delete('post/'.$post->image);
            }

        $post_image = Image::make($image)->resize(600,350)->stream();
        Storage::disk('public')->put('post/'.$image_name,$post_image);

        $post->user_id = Auth::id();
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->image = $image_name;
        $post->description = $request->description;
        $post->category_id = $request->category_id;

        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }

        //This will be done later
       /* if( Auth::user()->role_id == 1)
        {
            $post->view_count = 680;
            //This will be scheduled to run daily or so.
        } */

        $post->save();

        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync([]);
        }

        $request->session()->flash('success', 'Task was successful!');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $post = Post::find($id);

        if (Storage::disk('public')->exists('post/'.$post->image))
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->tags()->detach();
        $post->delete();
        
        session()->flash('success', 'Task was successful!');
        return redirect()->back();
    }
    

}
