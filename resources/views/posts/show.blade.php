@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-dark ">Back</a>
<img src="/storage/cover_images/{{$post->cover_image}}" class="card-img-top" alt="slika">
<h1>{{$post->title}}</h1>


<div>
    {{$post->body}}
</div>
<hr>
<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
@if (!Auth::guest())
    @if (Auth::user()->id == $post->user_id)
    

        <a href="/posts/{{$post->id}}/edit" class="btn btn-dark">Edit</a>
        <form action={{ action('PostsController@destroy', $post->id)}} method="post" >
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-primary">Del</button>
        </form>
    @endif
@endif
@endsection