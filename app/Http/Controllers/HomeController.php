<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\didTask;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function mylist(){
        $user=auth()->user()->id;
        $tasks=didTask::where('user_id',$user)->orderBy('created_at','desc')->get();
        return view('mylist',compact('tasks'));
    }
}
