<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Session;

class CommentController extends Controller
{
    public function storeComment(Request $request,$id)
    {
    	$comment = Comment::find($id);
    	$this->validate($request,[
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->post_id = $id;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->save();
        session()->flash('success', 'Comment succesfull!');
        return redirect()->back();
    }
}
