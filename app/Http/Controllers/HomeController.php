<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>'listUser']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Auth::user()->posts;
        for($i=0;$i<count(Auth::user()->posts);$i++){

           // print($posts[$i]->likes->first->like);
        }
        return view('home');
    }

    public function listUser(){
        $users = User::orderBy('id','desc')->paginate(40);
        return view('user.index')->withUsers($users);

    }

    public function showUser($id){
        $user = User::findorfail($id);

        return view('user.show')->withUser($user);
    }
}
