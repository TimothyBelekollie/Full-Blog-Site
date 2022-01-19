@extends('layouts.master')
@include('layouts.header')
@section('content')
<h2 class="header-title">Latest Blog Posts</h2>
<section class="cards-blog latest-blog">
  @foreach ($posts as $post)
      <div class="card-blog-content">
        <img src="{{asset($post->imagePath)}}" alt="" />
        <p>
         {{$post->created_at->diffForhumans()}}
          <span>Written By {{$post->user->name}}</span>
        </p>
        <h4>
          <a href="{{route('blog.show',$post)}}">{{$post->title}}</a>
        </h4>
      </div>

      @endforeach
  

  

  
</section>
@endsection