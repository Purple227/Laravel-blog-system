<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;

class UserController extends Controller
{
    public function authUser()
    {
    	$user = User::latest()->authUser()->paginate(10);
    	$user_count = $user->count();
    	return view('admin/user/auth_user', compact('user', 'user_count'));
    }

     public function author()
    {
    	$user = User::latest()->Author()->paginate(10);
    	$user_count = $user->count();
    	return view('admin/user/author', compact('user', 'user_count'));
    }

     public function admin()
    {
    	$user = User::latest()->Admin()->paginate(10);
    	$user_count = $user->count();
    	return view('admin/user/admin', compact('user', 'user_count'));
    } 

    public function updateToAuthor($id)
   {
   	$user = User::find($id);
   	$user->role_id = 2;
   	$user->save();
   	session()->flash('success', 'Task succesfull');
   	return redirect()->route('author');
   } 

    public function updateToAdmin($id)
   {
   	$user = User::find($id);
   	$user->role_id = 1;
   	$user->save();
   	session()->flash('success', 'Task succesfull');
   	return redirect()->route('admin');
   } 

    public function updateToUser($id)
   {
   	$user = User::find($id);
   	$user->role_id = 3;
   	$user->save();
   	session()->flash('success', 'Task succesfull');
   	return redirect()->route('auth.user');
   } 


   public function destroy($id)
   {
   	$user = User::find($id);
   	$user->delete();
   	session()->flash('success', 'User deleted succesfull');
   }


}
