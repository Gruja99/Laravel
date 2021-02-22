@extends('layouts.app')
@section('content')
    <h1>Edit posts</h1>
    <form action={{ action('PostsController@update', $post->id)}} method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="{{$post->title}}">

        </div>
        <div class="form-group">
            <label for="title">Body</label>
        <textarea name="body"  class="form-control" value="{{$post->body}}"></textarea>

        </div>
        
        <input type="file" name="cover_image" class="form-control">
        @method('PUT')
        <button type="submit" class="btn btn-dark">Ok</button>



    </form>
@endsection