@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-6 col-sm-offset">

    @if(Session::has('success'))
<div class="alert alert-success">

<a href="#" class="close" data-dismiss="alert">&times;</a>

{{ Session::get('success')}}

</div>
@endif

{!! Form::model($post,['method'=>'PUT','files'=>true,"route"=>['post.update',$post->id]]) !!}

<div class="panel panel-default">
<div class="panel-body">

<div class="form-group {{$errors->has('title')?'has error':''}}">
    {{ Form::text('title',null,['class'=>'form-control','placeholder'=>'post title'])}}

@if($errors->has('title'))
 <small class="text-danger">{{ $errors->first('title')}}</small>
@endif
</div>

<div class="form group">

<select class="form-control" name="category">
@foreach($categories as $category)
<option value="{{$category->id}}" {{$category->id == $post->category->id?"selected":''}} >{{$category->name}}</option>
@endforeach
</select>
</div>

<div class="form-group">
<input type="file" class="form-control" name="image">
</div>

<div class="form group {{$errors->has('body')?'has error':''}}">
    {{ Form::textarea('body',null,['class'=>'form-control','placeholder'=>'post body'])}}

@if($errors->has('body'))
<small class="text-danger">{{$errors->first('body')}}
@endif
</div>

<div class="form group {{$errors->has('body')?'has error':''}}">
<select class="form-control select2-class" name="tags[]" multiple>
    @foreach(Auth::user()->friends as $friend)
    <option value="{{$friend->user2->id}}">{{$friend->user2->username}}</option>
    @endforeach

</select>
</div>

<input type="submit" value="Post" class="btn btn-primary btn-block">

</div>
</div>
{!! Form::close() !!}


    </div>
</div>
@endsection