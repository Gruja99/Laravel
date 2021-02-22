@extends('layouts.app')
@section('content')
    <h1>Create posts</h1>
    <form action={{ action('PostsController@store')}} method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control">

        </div>
        <div class="form-group">
            <label for="title">Body</label>
            <textarea name="body" id="" class="form-control"></textarea>

        </div>
        
          
            <input type="file" name="cover_image" class="form-control">

       
        <button type="submit" class="btn btn-dark">Ok</button>



    </form>
@endsection