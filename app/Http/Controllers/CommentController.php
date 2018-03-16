<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Auth;
use App\Comment;
use App\Http\Resources\Comment as CommentResource;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        $comments = $post->comments()->with('user')->latest()->get();

        return CommentResource::collection($comments);
    }

    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $comment = $post->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);

        $comment = Comment::where('id', $comment->id)->with('user')->first();

        return new CommentResource($comment);
    }
}
