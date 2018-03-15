@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a style="margin-bottom:15px" href="{{route('posts.create')}}" class="btn btn-primary">Create Post</a>
                    <h3>Your Blog Posts</h3>
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->title}}</th>
                                <td><a href="{{route('posts.index')}}/{{$post->id}}/edit" class="btn btn-info">Edit</a></th>
                                <td>
                                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!! Form::close() !!}
                                </th>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        <p class="text-danger">No Posts found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
