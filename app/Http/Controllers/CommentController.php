<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use Session;
class CommentController extends Controller
{
    //

    public function index(Request $request){
        $this->validate($request,[
            'post_id'=>['exists:posts,id','numeric'],
            'comment'=>['required','max:255']
        ]);
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->save();
        
        Session::flash("success","Comment created");

        return redirect()->back();
    }
}
