<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;
use Auth;
use App\Post;
class CategoryController extends Controller
{
    //

    public function index(){
        //$categories = Category::all()->sortByDesc('id')->paginate(10);
        $categories = Category::orderBy('id','desc')->paginate(1);
        return view('category.index')->withCategories($categories);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>['required','max:255','unique:categories']
        ]);

        $category = new Category;
        $category->name =strtolower($request->name);
        $category->user_id = Auth::user()->id;
        $category->save();

        Session::flash('success',"category was added successfully");
        return redirect('/category');
    }

    public function showall($name){
        $category= Category::all()->where('name','*',$name)->first();
        if($category != null){
            $posts = Post::all()->where('category_id','*',$category->id)->sortByDesc('id');

            return view('category.showall')->withPosts($posts);
        }
        return redirect('/post');
        
    }
}
