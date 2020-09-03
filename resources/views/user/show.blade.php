@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                     Weclome {{$user->username}}
                    
                    <img src="{{ $user->profile_picture}}" alt="">
                    <div class="pull-right" data-friendid="{{$user->id}}"> 
                            
                        @if(Auth::check())
                        @php
                        $i=Auth::user()->friends->count();
                        $c=1;
                        @endphp
                        @foreach(Auth::user()->friends as $user_1)
                        @if($user_1->user2->id == $user->id )
                        
                        <a href="#" class="btn btn-link remove-friend">Remove Friend</a>
                        @break
                        @elseif($i==$c)
                        <a href="#" class="btn btn-link friend">Add Friend</a>
                        @endif
                        @php
                        $c+1;
                        @endphp
                        @endforeach
                       @if($i==0)
                        <a  href="#" class="btn btn-link friend">Add friend</a>
                        @endif
                        @endif
                        <a href="{{route('friend.show',$user->id)}}" class="btn btn-link">View Friends</a>
                    </div>

                <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#posts" aria-controls="posts" role="tab" data-toggle="tab">Posts</a></li>
    <li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Comments</a></li>
    <li role="presentation"><a href="#categories" aria-controls="categories" role="tab" data-toggle="tab">Categories</a></li>
    <li role="presentation"><a href="#likedposts" aria-controls="likedposts" role="tab" data-toggle="tab">Liked Posts</a></li>

     </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    
    <div role="tabpanel" class="tab-pane active" id="posts">
    {{$user->posts->count()}} post created
    @foreach($user->posts as $post)
    <div class="panel panel-default">
    <div class="panel-heading">
    <div class="panel-title">{{$post->title}}

                <div class="pull-right">
        <a href="{{route('post.show',[$post->id])}}" class="btn btn-link">show post</a>

                    <div class="dropdown" role="menu">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"  aria-expanded="false" v>
                                   <span class="caret"></span>
                                </a>

                        <ul>
                        <li><a href="{{route('post.show',[$post->id])}}">show post</li>
                        <li><a href="{{route('post.edit',[$post->id])}}">Edit post</li>
                        <li><a href="#" onclick="document.getElementById('deletef').submit()">delete post</a>
                            {!! Form::open(['method'=>'DELETE','id'=>'deletef','route'=>['post.delete',$post->id]]) !!}

                            {!! Form::close() !!}

                    </li>

                       
                        </ul></div></div></div></div>

    <div class="panel-body">
    {{$post->body}}
    </br>
    category <div class="badge">{{$post->category->name}}</div>
    </div>

    </div>
    @endforeach 
    
    </div>
    <div role="tabpanel" class="tab-pane" id="comments">
        {{$user->comments()->count()}} comments created
    @foreach($user->comments as $comment)
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="col-sm-9">
    {{$comment->comment}}
    </div>
    <div class="col-sm-3">
    <small><a href="{{route('post.show',$comment->post_id)}}" >View Post</a></small>
    </div>
    </div>
    <div class="panel-footer"></div>
    </div>
    @endforeach
    
    </div>
    <div role="tabpanel" class="tab-pane" id="categories">
    {{$user->categories->count()}} categories created
    @foreach($user->categories as $category)
    <div class="panel panel-default">
    <div class="panel-body">
    {{$category->name}}
    </div>
    <div class="panel-footer">
    </div>
    </div>

    @endforeach
    </div>

    <div role="tabpanel" class="tab-pane" id="likedposts">
    @foreach($user->likes as $like)

        @if($like->like)

    

<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title">
 {{$post->title}} created by:{{$post->user->username}}
 <div class="pull-right">
 <a href="{{route('post.show',[$post->id])}}" class="btn btn-link">show post</a>


 <div class="dropdown" role="menu">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"  aria-expanded="false" v>
                                   <span class="caret"></span>
                                </a>

                        <ul>
                        <li><a href="{{route('post.show',[$post->id])}}">show post</li>
                        <li><a href="{{route('post.edit',[$post->id])}}">Edit post</li>
                        <li><a href="#" onclick="document.getElementById('deletef').submit()">delete post</a>
                            {!! Form::open(['method'=>'DELETE','id'=>'deletef','route'=>['post.delete',$post->id]]) !!}

                            {!! Form::close() !!}

                    </li>

                       
                        </ul>


</div>



 </div>
</div>
</div>
<div class="panel-body">
{{$post->body}}

@if($post->image != null)
<img src="/images/{{$post->image}}" alt="image" width="100%" height="300">
@endif
<br>
<div class="badge">Category:{{$post->category->name}}</div>
</div>
<div class="panel-footer" data-postid="{{$post->id}}">
<a href="#" class="btn btn-link like active-like">Like</a>
<a href="#" class="btn btn-link like">Dislike</a>
<a href="{{route('post.show',[$post->id])}}" class="btn btn-link"> Comment</a>
</div>
</div>


    





        @endif
    @endforeach
    </div>
    
  

</div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
