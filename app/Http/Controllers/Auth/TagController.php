<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

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
    
        $tag->save();

        $request->session()->flash('success', 'Task was successful!');
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
        $tag->posts()->detach();
        $tag->delete();
        
        session()->flash('success', 'Task was successful!');
        return redirect()->back();
    }
}
