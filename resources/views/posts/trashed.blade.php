@extends('Layouts.master')
@section('content')
<div class="main-content mt-5">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6">
          <h4>Post Trashed</h4>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
          <a class="btn btn-success mx-1" href="{{route('Posts.create')}}">Create</a>
          <a class="btn btn-warning mx-1" href="{{ route('Posts.index') }}">All Posts</a>  
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
          @foreach ($posts as $post)
              
          <tr>
            <th scope="row">{{$post->id}}</th>
            <td>
              <img src="{{asset($post->image)}}" alt="{{$post->title}}" width="80">
            </td>
            <td>{{$post->title}}</td>
            <td>{{$post->description}}</td>
            <td>{{$post->category->name}}</td>
            <td>{{date('d-m-Y',strtotime($post->created_at))}}</td>

            <td>
              <div class="d-flex">
                <a href="{{route('Posts.restore',$post->id)}}" class="btn-sm btn-success btn ">Restore</a>
                <form action="{{route('Posts.force_delete',$post->id)}} " method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger"> Delete</button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{-- {{$posts->links()}} --}}
    </div>
  </div>
</div>
@endsection