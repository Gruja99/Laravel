@extends('layouts.app')

@section('content')
<form action="posts/search" method="GET">
    <input type="search" name="search"><button type="submit">Search</button>
</form>
@foreach ($posts as $post)

<div class="row">
   
    <div class="card w-75">
        <img src="/storage/cover_images/{{$post->cover_image}}" class="card-img-top" alt="slika">
        <div class="card-body">
  
             <h3 class="card-title"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
             <small class="card-text">Written on {{$post->created_at}} by {{$post->user->name}} </small>

         </div>
    </div>
    <br>
</div>

@endforeach
@endsection