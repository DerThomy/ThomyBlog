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

    @if(!Auth::guest() || Auth::guard('admin')->check() || Auth::guard('superadmin')->check())
        @if(isset(Auth::user()->id))
            @if(Auth::user()->id == $post->user_id)
                <a href="{{route('posts.index')}}/{{$post->id}}/edit" class="btn btn-info">Edit</a>

                {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!! Form::close() !!}
            @endif
        @else
            <a href="{{route('posts.index')}}/{{$post->id}}/edit" class="btn btn-info">Edit</a>

            {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif

    <h3 style="margin-top:10px">Comments:</h3>
    <div style="margin-bottom:50px" v-if="user">
        <textarea v-model="commentBox" name="body" id="" rows="3" class="form-control" placeholder="Leave a comment"></textarea>
        <button class="btn btn-info" style="margin-top:10px" @click.prevent="postComment">Save Comment</button>
    </div>
    <h4 v-else>
        You must be <a href="{{route('login')}}">logged in</a> to write comments
    </h4>
    <hr>
    <div class="media" style="margin-top:20px;" v-for="comment in comments">
        <div class="media-left">
            <a href="#">
                <img src="http://placeimg.com/80/80" alt="..." class="media-object">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">@{{comment.user.name}}</h4>
            <p>
                @{{comment.body}}
            </p>
            <span>on @{{comment.created_at}}</span>
        </div>
    </div>

    
@endsection

@section('scripts')
<script>
        
    const app = new Vue({
        el: '#app',
        data: {
            comments: {},
            commentBox: '',
            post: {!! $post->toJson() !!},
            user: {!! Auth::guard('web')->check() ? Auth::guard('web')->user()->toJson() : 'null' !!}
        },
        mounted() {
            this.getComments();
            this.listen();
        },
        methods: {
            getComments() {
                axios.get(`{{route('index')}}/api/post/${this.post.id}/comments`)
                    .then((response) => {
                        this.comments = response.data.data
                    })
                    .catch(function (error) {
                        alert('Failed loading Comments, try again or inform your admin');
                        console.log(error);
                    });
            },
            postComment() {
                axios.post(`{{route('index')}}/api/post/${this.post.id}/comment`, {
                    api_token: this.user.api_token,
                    body: this.commentBox
                })
                .then((response) => {
                    this.comments.unshift(response.data.data);
                    this.commentBox = '';
                })
                .catch(function (error) {
                    alert('Failed to send Comment, try again or inform your admin');
                    console.log(error);
                });
            },
            listen() {
                Echo.channel('post.'+this.post.id)
                    .listen('NewComment', (comment) => {
                        this.comments.unshift(comment);
                    })
            }
        }
    });

</script>
@endsection