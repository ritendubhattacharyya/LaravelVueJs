<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\App;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function store($id)
    {
        $attribute = request()->validate([
            'comment' => 'required'
        ]);
        $attribute['user_id'] = auth()->user()->id;
        $attribute['post_id'] = $id;

        Comment::create($attribute);
        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $this->authorize('deleteComment', $comment->user);
        $comment->delete();
        return back();
    }
}
