<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Jobs\AddPostJob;

class AdminController extends Controller
{
    public function index() 
    {
        $sortBy = request('sortBy');
        $descending = request('descending');
        $page = request('page');
        $rowsPerPage = request('rowsPerPage');
        $filter = request('filter');
        $userId = request('userId');

        $user = User::find($userId);
        // return response()->json($user);

        $startRow = ($page - 1) * $rowsPerPage;

        $query = Post::join('users', 'users.id', '=', 'posts.user_id')->select('posts.*','users.name')->orderBy($sortBy, ($descending) ? 'desc' : 'asc');

        if($user->role !== 'admin') {
            $query = $query->where('user_id', $userId);
        }

        if($filter !== '') {
            $query = $query->where('title', 'LIKE', '%' . $filter . '%');
        }

        $total = $query->count();
        $fetchCount = $rowsPerPage === 0 ? $rowsPerPage : $total;

        $rowsPerPage = $rowsPerPage === 0 ? $total : $rowsPerPage;

        $posts = $query->skip($startRow)->take($rowsPerPage)->get();


        foreach($posts as $post ) {
            $actions = [];
            $actions[] = [
                'title' => 'Edit',
                'link' => '/admin/posts/'.$post->id.'/edit/'.$post->user_id,
                'name' => 'edit',
                'icon' => 'create',
                'colour' => 'primary',
                'postId' => $post->id
            ];
            $actions[] = [
                'title' => 'Delete',
                'link' => '/posts/'.$post->id.'/delete',
                'name' => 'delete',
                'icon' => 'delete',
                'colour' => 'negative',
                'postId' => $post->id
            ];
            $post->actions = $actions;
        }

        $result = [
            'items' => $posts,
            'total' => $fetchCount,
            'page' => $page + 1,
            'rowsPerPage' => $rowsPerPage,
            'sortBy' => $sortBy,
            'descending' => $descending
        ];

        return response()->json($result);
    }

    public function edit($id) 
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    public function update($id) 
    {
        $post = Post::find($id);
        if(auth()->user()->role !== 'admin') 
        {
            if($post->user_id !== auth()->user()->id)
            {
                return response()->json('not authorized', 422);
            }
        }
        $attribute = [
            'title' => request('title'),
            'body' => request('body')
        ];

        $post->update($attribute);
    }

    public function destroy($id) 
    {
        $post = Post::find($id);
        if(auth()->user()->role !== 'admin')
        {
            if($post->user_id !== auth()->user()->id)
            {
                return response()->json('not authorized', 422);
            }
        }
        $post->delete();
    }

    public function store(PostRequest $request) 
    {
        $attribute = $request->validated();
        $attribute['user_id'] = auth()->user()->id;
        $this->dispatch(new AddPostJob($attribute));
    }

}
