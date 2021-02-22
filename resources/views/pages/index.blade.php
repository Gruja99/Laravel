@extends('layouts.app')

@section('content')
<div class="jumbotron text-center">
    <h1 >{{$title}}</h1>
        <p >This laravel aplication</p>
    <p><a href="/login" role='button' class="btn btn-primary">Login</a> <a href="/register" role='button' class="btn btn-danger">Register</a></p>
</div>
@endsection