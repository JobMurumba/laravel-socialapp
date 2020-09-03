@extends('layouts.app')

@section('content')
  <div class="container">
        @if(Session::has('success'))
        <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {{Session::get('success')}}
        </div>
        @endif
  <div class="col-sm-6">


@foreach($categories as $category)
<div class="panel panel-default">
<div class="panel-body">
{{$category->name}}
</div>
<div class="panel-footer">
created by:{{$category->user->username}}
</div>
</div>
@endforeach
{{$categories->links()}}
  </div>

  <div class="col-sm-6">
  <div class="vell">
  
  
  <form method="post">
  @csrf

  <div class="form-group {{$errors->has('name')? 'has error':''}}">
  <label for="name  control-label">Name</label>
  <input type="text" class="form-control" id="name"  name="name" placeholder="enter category">
  @if($errors->has('name'))
    <small class="text-danger">{{$errors->first('name')}}</small>
  @endif
  </div>

  <input type="submit" value="Submit" class="btn btn-success btn-block">
  </form>
  </div>

  </div>

  </div>
@endsection