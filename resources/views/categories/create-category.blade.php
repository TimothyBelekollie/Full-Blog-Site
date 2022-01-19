@extends('layouts.master')
@section('content')
<main class="container" style="background-color:#fff;">
<section id="contact-us">
    <h1 style="padding-top:50px; ">Create New Category!</h1>
    {{-- Contact form --}}
    @include('includes.flashmessage');
    <div class="contact-form">
<form action="{{route('categories.store')}}" method="POST" >
    @csrf

{{-- Title --}}
<label for="name"><span>Name</span></label>
<input type="text" name="name" id="name" value="{{old('name')}}"/>
@error('name')
<p style="color: red; margin-bottom:25px;">{{$message}}</p>
    
@enderror


{{-- Button --}}
<input type="submit" value="submit">

</form>
</div>
<div class="create-categories">
<a href="{{route('categories.index')}}">Categories List <span>&#8594;</span></a>
</div>

</section>

</main>



@endsection