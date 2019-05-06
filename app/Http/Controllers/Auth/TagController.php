<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = Tag::latest()->paginate(5);
        $tag_count = Tag::count();
        return view('tag_category/tag/index', compact('tag', 'tag_count'));
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
            'name' => 'required|unique:tags'
        ]);
         // Use tag name as slug
        $slug = str_slug($request->name);

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = $slug;
        $tag->user_id = Auth::id();
    
        $tag->save();

        $request->session()->flash('success', 'Task was successful!');
        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        $post = $tag->posts()->paginate(6);
        return view('tag_category/tag/show', compact('tag', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('tag_category/tag.edit', compact('tag'));
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
        $tag = Tag::find($id);

        $this->validate($request,[
            'name' => 'required|unique:tags'
        ]);

         // Use tag name as slug
        $slug = str_slug($request->name);

        $tag->name = $request->name;
        $tag->slug = $slug;

        if( $tag->user_id == Auth::id() &&  Auth::user()->role_id == 2 )
         {
        $tag->save();
        session()->flash('success', 'Task succesfull!');
        return redirect()->route('tag.index');
         }

        if( Auth::user()->role_id == 1 )
        {
        $tag->save();
        session()->flash('success', 'Task succesfull!');
        return redirect()->route('tag.index');
         }

        $request->session()->flash('fail', 'You cannot edit someone else tag!');
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);

        if( $tag->user_id == Auth::id() &&  Auth::user()->role_id == 2 )
        {
        $tag->posts()->detach();
        $tag->delete();
        session()->flash('success', 'Task succesfull!');
        return redirect()->back();
        }

        if( Auth::user()->role_id == 1 )
        {
        $tag->posts()->detach();
        $tag->delete();
        session()->flash('success', 'Task succesfull!');
        return redirect()->back();
        }
        
        session()->flash('success', 'Task was successful!');
        return redirect()->back();
    }
}
