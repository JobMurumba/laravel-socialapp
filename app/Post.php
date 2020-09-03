<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function category(){

        return $this->belongsto('App\Category','category_id');
    }

    public function user(){
        return $this->belongsto('App\User');
    }
    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function friends(){
        return $this->belongsToMany('App\Friend');
    }
}
