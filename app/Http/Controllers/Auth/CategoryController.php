<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $category = Category::latest()->paginate(5);
        $category_count = Category::count();
        return view('tag_category/category.index', compact('category', 'category_count'));
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
            'name' => 'required|unique:categories'
        ]);
         // Use tag name as slug
        $slug = str_slug($request->name);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
    
        $category->save();

        $request->session()->flash('success', 'Task was successful!');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $post = $category->posts();
        return view('tag_category/category/show', compact('category', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('tag_category/category/edit', compact('category'));
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

       $category = Category::find($id);
         $this->validate($request,[
            'name' => 'required|unique:categories'
        ]);
         // Use tag name as slug
        $slug = str_slug($request->name);

        $category->name = $request->name;
        $category->slug = $slug;
    
        $category->save();

        $request->session()->flash('success', 'Task was successful!');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $category = Category::find($id);
         $category->delete();
        
        session()->flash('success', 'Task was successful!');
        return redirect()->back();
    }
}
