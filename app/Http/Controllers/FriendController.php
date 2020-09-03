<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use Auth;
use App\User;
class FriendController extends Controller
{
    //
    public function index(Request $request){
        $friend = new Friend;
        $friend->user_id_1 = Auth::user()->id;
        $friend->user_id_2 = $request->friendid;
        $friend->save();

        return [
            "friendid"=>$request->friendid
        ];
    }

    public function showfriends($id){
        $user = User::findorfail($id);
        return view('friend.show')->withUser($user);
    }

    public function remove(Request $request){
        $friend  = Friend::all()->where('user_id_1','=',Auth::user()->id)->where('user_id_2','=',$request->friendid)->first();
        $friend->delete();

        return [
            "friendid"=>$request->friendid
        ];
    }

    public function request(Request $request){
        $user = Friend::all()->where('user_id_2','=',Auth::user()->id)->where('user_id_1',"=",$request->user_id)->first();
        if($request->isRequest){
            $user->approved=true;
            $user->save();
            return [
                "user_id"=>$request->user_id,
                "true"=>true
            ];
        }else{
            $user->delete();
            return [
                "user_id"=>$request->user_id,
                "true"=>false
            ];
        }
    }
}
