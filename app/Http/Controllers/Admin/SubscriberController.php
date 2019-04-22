<?php

namespace App\Http\Controllers\Admin;

use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->paginate(8);
        return view('admin.subscriber',compact('subscribers'));
    }


    public function destroy($id)
    {
        $subscriber = Subscriber::find($id);
        $subscriber->delete();
        session()->flash('success', 'Task was succesfull!');
        return redirect()->back();
    }
}
