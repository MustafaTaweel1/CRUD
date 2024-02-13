
@extends('Layouts.master')
@section('content')
<div class="main-content mt-5">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6">
          <h4>all post</h4>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
          <a class="btn btn-success mx-1" href="{{route('Posts.index')}}">AllPosts</a>
          <a class="btn btn-warning mx-1" href="{{route('Posts.trashed')}}">Trashed</a>  
        </div>
    </div>
  </div>
  @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{$error}}</div>
    @endforeach    
  @endif
    <div class="card-body">
      <form action="{{route('Posts.store')}}" method="post" enctype="multipart/form-data">
      @csrf
        <div class="from-group">
          <label for="">Image</label>
          <input type="file" name="image" id="image"  class="form-control">
        </div>
        <div class="form-group">
          <label for="">Title</label>
          <input type="text" name="title" id="title"  class="form-control">
        </div>
        <div class="from-group">
          <label for="">Category</label>
          <select name="category_id" id="" class="form-control">
            <option value="">---Select---</option>
            @foreach ($category as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="from-group">
          <label for="">Description</label>
          <textarea cols="30" rows="10" name="description" id="description" class="form-control"></textarea>
        </div>
        
        <div class="from-group">
        <button class="btn btn-primary"> Submit</button>
        </div>
        
      </form>
    </div>
  </div>
</div>
@endsection    
