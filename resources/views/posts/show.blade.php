@extends('layouts.app')

@section('content')
    <a style="margin-bottom:25px" href="{{route('posts.index')}}" class="btn btn-success">Go Back</a>
    <h1>{{$post->title}}</h1>
    <img style="width:100%" src="{{route('index')}}/storage/cover_images/{{$post->cover_image}}" alt="Cover-Image">
    <article>
        <p>{!!$post->body!!}<p>
    </arcticle>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="{{route('posts.index')}}/{{$post->id}}/edit" class="btn btn-info">Edit</a>

            {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif
@endsection