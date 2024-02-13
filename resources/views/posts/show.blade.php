@extends('Layouts.master')
@section('content')
<div class="main-content mt-5">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6">
          <h4>{{$posts->title}}</h4>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
          <a class="btn btn-success mx-1" href="{{route('Posts.index')}}">AllPosts</a>
          @can('delete', $posts)
          <a class="btn btn-warning mx-1" href="{{route('Posts.trashed')}}">Trashed</a>  
          @endcan
        </div>
    </div>
  </div>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Category</th>
            <th scope="col">Publish Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">{{$posts->id}}</th>
            <td><img src="{{asset($posts->image)}}" alt="" width="80"></td>
            <td>{{$posts->title}}</td>
            <td>{{$posts->description}}</td>
            <td>{{$posts->category->name}}</td>
            <td>{{$posts->created_at}}</td>
            <td>
              {{-- <a href="{{route('Posts.show')}}" class="btn btn-sm btn-success">Show</a> --}}
              {{-- <a href="{{route('Posts.edit')}}" class="btn btn-sm btn-primary" >Edit</a> --}}
              {{-- <a href="{{route('Posts.destory')}}" class="btn btn-sm btn-danger" >Delete</a> --}}
            </td>

          </tr>
        
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection