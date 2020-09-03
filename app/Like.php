<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    public function user(){
        $this->belongsto('App\User');
    }

    public function post(){
        $this->belongsto('App\Post');

    }
}
