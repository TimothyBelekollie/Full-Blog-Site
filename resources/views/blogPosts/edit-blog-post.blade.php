@extends('layouts.master')
@section('content')
<main class="container" style="background-color:#fff;">
<section id="contact-us">
    <h1 style="padding-top:50px; ">Edit Post</h1>
    {{-- Contact form --}}
    @include('includes.flashmessage');
    <div class="contact-form">
<form action="{{route('blog.update', $post)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf

{{-- Title --}}
<label for="title"><span>Title</span></label>
<input type="text" name="title" id="title" value="{{$post->title}}"/>
@error('title')
<p style="color: red; margin-bottom:25px;">{{$message}}</p>
    
@enderror
{{-- image --}}
<label for="image"><span>Image</span></label>
<input type="file" name="imagePath" id="image" value="{{old('image')}}">
@error('imagePath')
<p style="color: red; margin-bottom:25px;">{{$message}}</p>
    
@enderror
{{-- body --}}
<label for="body"><span>Body</span></label>
<textarea name="body" id="body" >{{$post->body}}</textarea>
@error('body')
<p style="color: red; margin-bottom:25px;">{{$message}}</p>
    
@enderror
{{-- Button --}}
<input type="submit" value="submit">

</form>
</div>


</section>

</main>



@endsection