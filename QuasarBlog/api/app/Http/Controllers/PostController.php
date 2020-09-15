<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class PostController extends Controller
{
//    public function __construct()
//    {
//        // $this->middleware('auth:web', ['except' => ['index']]);
//        $this->middleware('auth:web')->except('index');
//    }

    public function index()
    {
        $posts = Post::latest()->get();
        return view('welcome', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);
//        $comments = $post->comments->sortBy('created_at');
        $comments = Comment::latest()->where('post_id', $id)->get();
        return view('show-post', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
}
