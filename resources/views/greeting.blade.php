@extends('Layouts.master')
@section('content')
<DIV>
  <div>
    <a href="{{route('greeting','en')}}" class="btn btn-primary">English</a>
    <a href="{{route('greeting','ar')}}" class="btn btn-secondary">Arabic </a>
  </div>
  <h1>{{__('frontend.welcome to our site')}}</h1>
  <div class="row">
      <ul class="row">
        <li>{{__('frontend.Home')}}</li>
        <li>{{__('frontend.About')}}</li>
        <li>{{__('frontend.Contact')}}</li>
        <li>{{__('frontend.More')}}</li>
        <li></li>
      </ul>
    </div>
  </DIV>
    @endsection
    