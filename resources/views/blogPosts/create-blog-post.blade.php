@extends('layouts.master')
@section('content')
<main class="container" style="background-color:#fff;">
<section id="contact-us">
    <h1 style="padding-top:50px; ">Create New Post!</h1>
    {{-- Contact form --}}
    @include('includes.flashmessage');
    <div class="contact-form">
<form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

{{-- Title --}}
<label for="title"><span>Title</span></label>
<input type="text" name="title" id="title" value="{{old('title')}}"/>
@error('title')
<p style="color: red; margin-bottom:25px;">{{$message}}</p>
    
@enderror
{{-- image --}}
<label for="image"><span>Image</span></label>
<input type="file" name="imagePath" id="image" value="{{old('image')}}">
@error('imagePath')
<p style="color: red; margin-bottom:25px;">{{$message}}</p>
    
@enderror
{{-- Drop Down --}}

<label for="categories"><span>Choose a category</span></label>
<select name="category_id" id="categories">
    <option selected disabled>Select Option</option>
    
@foreach ($categories as $category )
<option value="{{$category->id}}">{{$category->name}}</option>
@endforeach
</select>
@error('category_id')
<p style="color: red; margin-bottom:25px;">{{$message}}</p>
    
@enderror
{{-- body --}}
<label for="body"><span>Body</span></label>
<textarea name="body" id="body" >{{old('body')}}</textarea>
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