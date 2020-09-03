<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    public function user(){
        return $this->belongsto('App\User');
    }
    public function post(){
        return $this->belongsto('App\Post');
    }
}
