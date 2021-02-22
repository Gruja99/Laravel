@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="panel-body">
                       
                            <a class="nav-link" href="/posts/create">Create Post</a>
                            <h3>Your posts</h3>
                            
                                
                          
                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a></td>
                                    <td><form action={{ action('PostsController@destroy', $post->id)}} method="post" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Del</button>
                                    </form></td>
                                </tr>
                                    
                                @endforeach

                            </table> 
                            
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
