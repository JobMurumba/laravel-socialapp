<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Session;
use Image;
use App\Category;
use Storage;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all()->sortByDesc('id');
        $categories = Category::all();
        
        // foreach($posts as $post){
        //     print($post->category->name);
        // }
        //  for($i=1;$i<count($posts);$i++){
            
        //      print((gettype($posts[$i]->category)).":".$i);
         
        //  }
        return view('post.index')->withPosts($posts)->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request);
        $this->validate($request,[
            "title"=>["required","max:255","unique:posts"],
            "image"=>['nullable','image'],
            "body"=>["required","max:255"]
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id=$request->category;
        $post->user_id = Auth::user()->id;
        if($request->hasfile('image')){
            $image = $request->file('image');
            $filename= time().".".$image->getClientOriginalExtension();
            $location =public_path('/images/'.$filename);
            Image::make($image)->resize(800,600)->save($location);
            $post->image =$filename;
        }
       
        $post->save();
        if(isset($request->tags)){
            $post->friends()->sync($request->tags,false);
        }

        Session::flash('success',"Post was successfully added");
        return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findorfail($id);
        return view('post.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findorfail($id);
        if(Auth::user()->id != $post->user->id){
            abort(404);
        }

        if($post == null){
            abort(404);
        }
        $categories = Category::all();
        return view('post.edit')->withPost($post)->withCategories($categories);
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
        //

        $post = Post::findorfail($id);
        if(Auth::user()->id != $post->user->id){
            abort(404);
        }

        if($post == null){
            abort(404);
        }
         $this->validate($request,[
            "title"=>["required","max:255","unique:posts,title,$id"],
            "image"=>['nullable','image'],
            "body"=>["required","max:255"]
        ]);

        //$post = Post::findorfail($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id=$request->category;
        $post->user_id = Auth::user()->id;
        if($request->hasfile('image')){
            $image = $request->file('image');
            $filename= time().".".$image->getClientOriginalExtension();
            $location =public_path('/images/'.$filename);
            Image::make($image)->resize(800,600)->save($location);
            
            if($post->image != null){
                Storage::delete($post->image);
            }
            $post->image =$filename;
        }
        $post->save();

        if(isset($request->tags)){
            $post->friends()->sync($request->tags);
        }


        Session::flash('success',"Post was successfully edited");
        return redirect('/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $post = Post::findorfail($id);
        if(Auth::user()->id != $post->user->id){
            abort(404);
        }

        if($post == null){
            abort(404);
        }
       
        if($post->image !=null){
            Storage::delete($post->image);
        }
        $post->delete();

        Session::flash("success","post successfully deleted");
        return redirect()->back();
    }
}
