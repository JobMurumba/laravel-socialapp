@extends('layouts.app')
@section('content')

<div class="container">
<div class="col-sm-6 col-sm-offset">

@foreach($posts as $post)
<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title">
 {{$post->title}} created by:{{$post->user->username}}

 @if(($post->friends()->count())>0)
 <small>
with
@foreach($post->friends as $tag)
 {{$tag->user2->username}}
@endforeach
 @endif
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
<div class="panel-footer"  data-postid="{{$post->id}}">
@php
$i = Auth::user()->likes->count();
$c=1;
$likeCount=$post->likes->where('like','=',true)->count();
$dislikeCount=$post->likes->where('like','=',false)->count();
@endphp
@foreach(Auth::user()->likes as $like)
@if($like->post_id == $post->id)
        @if($like->like)
        <a href="#" class="btn btn-link like active-like">Like
        <span class="badge">{{$likeCount}}</span>
        </a>
        <a href="#" class="btn btn-link like">Dislike
        <span class="badge">{{$dislikeCount}}</span>
        </a>
        @else
        <a href="#" class="btn btn-link like">Like
        <span class="badge">{{$likeCount}}</span>
        </a>
        <a href="#" class="btn btn-link like active-like">Dislike
        <span class="badge">{{$dislikeCount}}</span>
        </a>
        @endif
        @break
@elseif($c==$i)
<a href="#" class="btn btn-link like">Like
<span class="badge">{{$likeCount}}</span>
</a>
<a href="#" class="btn btn-link like">Dislike
<span class="badge">{{$dislikeCount}}</span>
</a>
@endif
@php
$c=1;
@endphp
@endforeach
@if($i==0)
<a href="#" class="btn btn-link like">Like</a>
    <a href="#" class="btn btn-link like">Dislike</a>
@endif
<a href="{{route('post.show',[$post->id])}}" class="btn btn-link"> Comment</a>
</div>

</div>
@endforeach

</div>
</div>
@endsection