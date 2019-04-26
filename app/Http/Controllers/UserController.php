<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{	

	public function edit($id)
	{
		$user = User::find(Auth::id());
		return view('update_profile/update_profile', compact('user'));
	}


    public function updateProfile($id, Request $request)
    {
    	$user = User::find(Auth::id());

    	$this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|image',
            'about' => 'required',
        ]);

         $image = $request->file('image');

        $slug = str_slug($request->name);
        $shorten_slug = substr($slug, 0, 15);
        $slug = $shorten_slug; 
        $slug = str_replace(" ", "-", $slug); 

         if(isset($image))
        {
            $image_name = $slug.'.'.$image->getClientOriginalExtension();
        }

        if (!Storage::disk('public')->exists('profile')) 
        {
            Storage::disk('public')->makeDirectory('profile');
        }

         //delete old post image
        if(Storage::disk('public')->exists('profile/'.$user->image))
        {
            Storage::disk('public')->delete('profile/'.$user->image);
        }

        $profile = Image::make($image)->resize(600,350)->stream();
        Storage::disk('public')->put('profile/'.$image_name,$profile);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $image_name;
        $user->about = $request->about;
        $user->save();

        session()->flash('success', 'Profile updated succesfully');
        if(Auth::user()->role_id == 1)
        return redirect()->route('admin.dashboard');
        else
        {
            return redirect()->route('author.dashboard');
        }
    }

}
